@extends (request()->ajax() ? 'cms.layouts.blank' : 'cms.layouts.master')

@section ('content')
<div class="breadcrumb-main">
    <h4 class="text-capitalize breadcrumb-title">Setting</h4>
</div>

<form action="{{ route('cms.do-setting') }}" class="row form-setting ajax-form" method="post">
    @csrf
    <div class="col-xxl-3 col-lg-4 col-sm-5 mb-3">
        <!-- Profile Acoount -->
        <div class="card mt-3 mb-3">
            <div class="card-body text-center p-0">
                <div class="ps-tab p-20 pb-3">
                    <div class="nav flex-column text-left" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        @foreach ($setting as $group_key => $items)
                        <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="v-pills-{{ $group_key }}-tab" data-toggle="pill" href="#v-pills-{{ $group_key }}" role="tab" aria-controls="v-pills-{{ $group_key }}" aria-selected="true">
                            <span data-feather="arrow-right-circle"></span> {{ strtoupper($items['title'] ?? '-') }}
                        </a>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
        <!-- Profile Acoount End -->
    </div>
    <div class="col-xxl-9 col-lg-8 col-sm-7 mb-3">
        <div class="tab-content" id="v-pills-tabContent">
            @foreach ($setting as $group_key => $items)
            <div class="tab-pane fade  show {{ $loop->first ? 'active' : '' }}" id="v-pills-{{ $group_key }}" role="tabpanel" aria-labelledby="v-pills-{{ $group_key }}-tab">
                <!-- Edit Profile -->
                <div class="edit-profile mt-3">
                    <div class="card">
                        <div class="card-header px-sm-25 px-3">
                            <div class="edit-profile__title">
                                <h6>{{ strtoupper($items['title'] ?? '-') }}</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="edit-profile__body mx-lg-20">
                                @foreach ($items['items'] ?? [] as $item)
                                <div class="form-group mb-20">
                                    <label for="names" class="d-block{{ isset($item->getConfig()['required']) ? 'required' : '' }}">{{ $item->getTitle() }}</label>

                                    @if ($item->getType() == 'image')
                                        {!! Input::call('image', [
                                            'name' => $group_key.'['.$item->getName().']',
                                            'attr' => $item->getConfig(),
                                            'value' => $item->getValue(),    
                                        ]) !!}
                                    @elseif ($item->getType() == 'textarea')
                                    <textarea name="{{ $group_key }}[{{ $item->getName() }}]" class="form-control" {!! arrayToHtmlProp($item->getConfig() ?? []) !!}>{{ $item->getValue() }}</textarea>
                                    @elseif ($item->getType() == 'select')
                                        {!! Input::call('select', [
                                            'name' => $group_key . '['.$item->getName().']',
                                            'value' => $item->getValue(),
                                            'lists' => $item->getConfig()['lists'] ?? [],
                                        ]) !!}
                                    @elseif ($item->getType() == 'yesno')
                                        {!!
                                            Input::call('yesno', [
                                                'name' => $group_key . '['.$item->getName().']',
                                                'value' => $item->getValue(),
                                            ])    
                                        !!}                                    
                                    @else
                                    <input type="{{ $item->getType() ?? 'text' }}" name="{{ $group_key }}[{{ $item->getName() }}]" class="form-control" {!! arrayToHtmlProp($item->getConfig() ?? []) !!} value="{{ $item->getValue() }}">
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Edit Profile End -->
            </div>
            @endforeach
        </div>

        <div class="button-group d-flex flex-wrap pt-30 mb-15">
            <button class="btn btn-primary btn-default btn-squared mr-15 text-capitalize">Save Setting</button>
            <button class="btn btn-light btn-default btn-squared fw-400 text-capitalize">Cancel</button>
        </div>

    </div>
</form>
@stop

@push ('script')
<script>

</script>
@endpush