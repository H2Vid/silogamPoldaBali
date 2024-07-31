@if (isset($batch_delete_route))
<div class="batchbox" data-hash="{{ $hash }}" style="display:none">
    <button data-href="{{ $batch_delete_route }}" type="button" class="btn btn-danger mb-3 btn-batch-delete">Delete Selected</button>
    <hr class="mt-0 mb-3">
</div>
@endif

<div class="datatable-holder">
    <table class="datatable table mb-0" data-title="{{ $title ?? 'datatable' }}-{{ $hash }}">
        <thead>
            <tr class="{{ $title ?? 'datatable' }}-header">
                @if (isset($batch_delete_route))
                <th>
                    <input class="checkbox checker-all-{{ $hash }}" type="checkbox" id="">
                </th>
                @endif
                @foreach ($config as $cfg)
                <th>
                    <span class="{{ $title ?? 'datatable' }}-{{ $cfg->getField() }}">{{ $cfg->getLabel() ?? '-' }}</span>
                </th>
                @endforeach
                <th data-action>
                    <!-- Action -->
                </th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
