
@if(method_exists($model->getModel(), 'slugify'))
<div class="mb-3">
    <div class="input-group">
        <div class="input-group-append d-none d-md-flex">
            <span class="input-group-text" id="basic-addon1">{{ $model->getModel()->slugUrl() }}</span>
        </div>
        <input type="text" name="slug_master" class="form-control form-control-lg" readonly
        slug-master {{ isset($data->{$model->getModel()->slugField()}) ? 'saved-slug' : '' }}
        value="{{ $data->{$model->getModel()->slugField()} ?? null }}" placeholder="your-slug-url" 
        data-target="{{ $model->getModel()->slugTarget() }}">
        <div class="input-group-prepend">
            <button type="button" class="btn btn-secondary btn-change-slug">Change</button>
        </div>
    </div>
    <small>Note : slug will automatically appended with numeric value if data is already exists.</small>
</div>
@endif

@if (count($tabs) > 1)
<div class="mt-2 autocrud-tabs atbd-tab tab-horizontal">
    <ul class="nav nav-tabs" id="autocrud-tab" role="tablist">
        @foreach($tabs as $tabname)
            <li class="nav-item">
                <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ CMS::slugify($tabname) }}-tab" data-toggle="tab" href="#form-tab-{{ CMS::slugify($tabname) }}" role="tab">{{ strtoupper($tabname) }}</a>
            </li>
        @endforeach
    </ul>
</div>
@endif

<div class="tab-content autocrud-content" id="autocrud-tab-content">
    @foreach ($tabs as $tabname)
    <div class="tab-pane card-body fade {{ $loop->first ? 'show active' : '' }}" id="form-tab-{{ CMS::slugify($tabname) }}" role="tabpanel">
        @php
            $width = 0;
        @endphp

        <div class="row">
            @foreach (collect($config)->where('tab_group', $tabname) as $row)
                @if (!empty($data) && $row->getHideOnUpdate())
                    @continue
                @endif

                @php
                    $width += $row->getColumn();
                @endphp

                @if ($width > 12)
                    @php
                        $width = 0;
                    @endphp
                    </div><div class="row">
                @endif

                <div class="col-md-{{ $row->getColumn() }} col-sm-12">
                    @if ($row->getType() == 'view')
                        @if (View::exists($row->getViewSource()))
                            @include ($row->getViewSource())
                        @else
                            <div class="alert alert-danger">View <strong>{{ $row->getViewSource() }} doesnt exists</strong></div>
                        @endif
                    @else
                    <div class="form-group custom-form-group {!! $row->inputType() == 'radio' ? 'radio-box' : '' !!}" data-crud="{{ $row->getField() }}">
                        @if ($row->getHideLabel() == false)
                        <label class="{{ $row->isMandatory() ? 'required mandatory' : '' }}">{{ $row->getLabel() }}</label>
                        @endif

                        <div>
                            <?php
                            $attr = $row->getAttr() ?? [];
                            if (!isset($attr['data-name'])) {
                                $attr['data-name'] = $row->getField();
                            }

                            $is_translateable = false;
                            if (method_exists($model->getModel(), 'isTranslateable')) {
                                $is_translateable = $model->getModel()->isTranslateable();
                            }

                            $shown_value = null;
                            if (isset($data->{$row->getField()})) {
                                $shown_value = $data->{$row->getField()};
                            }
                            if (is_callable($row->getValue())) {
                                $shown_value = call_user_func($row->getValue(), $data);
                            }

                            if ($is_translateable && $row->getTranslateable()) {
                                $default_value = $shown_value;
                                $shown_value = [];
                                $shown_value[CMS::defaultLang()] = $default_value;
                                foreach (CMS::langs() as $langcode => $langname) {
                                    if ($langcode <> CMS::defaultLang()) {
                                        $shown_value[$langcode] = ( isset($data->{$model->getModel()->getKeyName()}) ? $data->outputTranslate($row->getField(), $langcode) : null );
                                    }
                                }
                            }
                            if ($row->getTabGroup() == 'seo') {
                                // fix broken position because of SEO tweak
                                if (isset($shown_value[CMS::defaultLang()]) && is_array($shown_value[CMS::defaultLang()])) {
                                    $shown_value = $shown_value[CMS::defaultLang()];
                                }
                            }
                            ?>
                            @include ('cms.form.partials.input-conditioning')
                        </div>

                        @if ($row->getNotes())
                        <div>
                            <small>{{ $row->getNotes() }}</small>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>

                @if ($width >= 12)
                    @php
                        $width = 0;
                    @endphp
                    </div><div class="row">
                @endif
            @endforeach    
        </div>

    </div>    
    @endforeach
</div>


