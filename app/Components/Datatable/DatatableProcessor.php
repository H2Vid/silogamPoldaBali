<?php
namespace App\Components\Datatable;

use Illuminate\Http\Request;
use CMS;

trait DatatableProcessor
{
    public string $datatable_error = '';

    public int $page = 1;
    public $raw_data = null;
    public $data = [];
    public int $data_count = 0;
    public $pk = null;

    public function datatableResponse(Request $request)
    {
        // prevent new hash on ajax request
        if ($request->table_hash) {
            $this->hash = $request->table_hash;
        }

        try {
            $this->prepareDataTableVariables($request);

            // generate builder with filter parameter if exists
            $this->generateDataByRequest($request);

            $this->data = [];
            if (method_exists($this, 'tableKey')) {
                $this->pk = $this->tableKey();
            }
            foreach ($this->raw_data as $item) {
                $checker = [];
                if (!empty($this->batch_delete_route)) {
                    $checker = [
                        '_checker' => '<input type="checkbox" class="checker-'.$this->hash.'" data-id="'.$item->{$this->pk}.'" value="1">'
                    ];
                }
                $this->data[] = array_merge($checker, (call_user_func($this->table_data, $item)));
            }

            if (empty($this->data)) {
                $this->data = $this->raw_data;
            }
        } catch (Exception | \Illuminate\Database\QueryException $e) {
            $this->datatable_error = $e->getMessage();
        }

        return $this->renderDatatableResponse($request);
    }

    public function prepareDataTableVariables(Request $request)
    {
        $this->columns = $request->columns;
        $this->start = $request->start ?? 0;
        $this->length = $request->length ?? 10;

        $this->pk = CMS::getPrimaryKeyField($this->getModel());

        $this->structure = $this->getConfig();
        $order_by = null;
        if (isset($request->order[0]['column'])) {
            $cindex = $request->order[0]['column'];
            $order_by = $this->columns[$cindex]['data'] ?? null;
        }
        $order_dir = $request->order[0]['dir'] ?? 'desc';
        $this->order_by = $order_by;
        $this->order_dir = $order_dir;
        $this->search_keyword = $request->search['value'] ?? null;
    }

    public function generateDataByRequest(Request $request, $paging=true)
    {
        $data = $this->getModel();
        $without_filter = $data;

        $search_handle = $this->getSearchHandle();
        if (is_callable($search_handle)) {
            $data = $search_handle($data, $this->search_keyword, $request);
        }
        
        // handle orderby
        if (strlen($this->order_by) > 0 && $this->order_by <> '_checker') {
            $data = $data->orderBy($this->order_by, $this->order_dir);
        } else {
            // default by Primary Key
            $data = $data->orderBy($this->default_sort_by ?? $this->pk, $this->default_sort_dir ?? $this->order_dir);
        }

        if ($paging) {
            $without_filter = clone $data;
            $datacount = $without_filter->count();

            $data = $data->skip($this->start);
            $data = $data->take($this->length);
            $this->data_count = $datacount;
            $this->data_count = $datacount;
            $this->page = ($this->start / $this->length) + 1;
            $this->raw_data = $data->get();
        } else {
            $data = $data->take(config('cms.max_export_row_limit'));
            $this->raw_data = $data->get();
        }
    }

    protected function renderDatatableResponse(Request $request)
    {
        if ($this->datatable_error) {
            return [
                'draw' => $request->draw ?? 0,
                'error' => $this->datatable_error
            ];
        } else {
            return [
                'draw' => $request->draw ?? 0,
                'page' => $this->page,
                'data' => $this->data,
                'recordsFiltered' => $this->data_count,
                'recordsTotal' => $this->data_count,
            ];
        }
    }    
}