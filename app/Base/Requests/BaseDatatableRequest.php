<?php
namespace App\Base\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CMS;

class BaseDatatableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return CMS::adminIsLoggedIn();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'draw' => 'required',
            'columns' => 'required|array',
            'columns.*.data' => 'required',
            'columns.*.searchable' => 'required',
            'columns.*.orderable' => 'required',
            'order' => 'required|array',
            'order.*.column' => 'required|numeric',
            'order.*.dir' => 'required',
            'start' => 'required|numeric',
            'length' => 'required|numeric', 
        ];
    }
}
