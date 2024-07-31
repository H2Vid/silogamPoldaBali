<script type="text/javascript">
if (typeof tb_data == 'undefined') {
    tb_data = {};
}

$(function(){
    tb_data['{{ $hash }}'] = $("table.datatable[data-title='{{ $title ?? 'datatable' }}-{{ $hash }}']").DataTable({
        'processing': true,
        'serverSide': true,
        'searching': true,
        'filter': true,
        'ajax': {
            type : 'POST',
            url	: '{{ $route ?? null }}',
            dataType : 'json',
            data : function(data){
                data._token = '{{ csrf_token() }}';
                data.table_hash = '{{ $hash }}';
            },
        },
        'createdRow': function( row, data, dataIndex ) {
            // Set the data-status attribute, and add a class
            $( row ).addClass('close-target');
        },

        'drawCallback': function(settings) {
            if (typeof afterDatatableLoad == 'function') {
                afterDatatableLoad();
            }
            initPlugins();
        },
		'columns' : [
			@if (isset($batch_delete_route))
            {"data" : "_checker"},
			@endif
            @foreach ($config as $cfg)
            {"data" : "{{ $cfg->getField() ?? 'fld_' . uniqid() }}"},
            @endforeach
            {"data" : "action"}
		],
		'columnDefs' : [
			@if (isset($batch_delete_route))
			{"targets": 0, "orderable": false},
			@endif
            @foreach ($config as $idx => $cfg)
            {"targets" : {{ $idx + (isset($batch_delete_route) ? 1 : 0) }}, "orderable" : {{ $cfg->getOrderable() ? 'true' : 'false' }}},
            @endforeach
            {"targets" : {{ count($config) + (isset($batch_delete_route) ? 1 : 0) }}, "orderable" : false}
		],
    });

	$(document).on('change', '.checker-all-{{ $hash }}', function(){
		cond = $(this).is(':checked');
		$(".checker-{{ $hash }}").each(function(){
			$(this).prop('checked', cond);
		});
		toggleBatchMode{{ $hash }}();
	});

	$(document).on('change', '.checker-{{ $hash }}', function(){
		toggleBatchMode{{ $hash }}();
	});

	$(".btn-batch-delete").on('click', function(e){
		e.preventDefault();
		output = '<p>Are you sure? Once deleted, you will not be able to recover the data</p><button class="btn btn-primary" data-dismiss="modal">Cancel</button> <button class="btn btn-danger" onclick="runRemoveBatch{{ $hash }}()">Yes, Delete</button>';
		toastr.info(output);
	});

});

function refreshDataTable{{ $hash }}(){
	tb_data['{{ $hash }}'].ajax.reload();
}

function toggleBatchMode{{ $hash }}(){
	cond = false;
	$(".checker-{{ $hash }}").each(function(){
		if($(this).is(':checked')){
			cond = true;
		}
	});

	console.log(cond);

	if(cond){
		//toggle down
		$(".batchbox[data-hash='{{ $hash }}']").slideDown();
	}
	else{
		//toggle up
		$(".batchbox[data-hash='{{ $hash }}']").slideUp();
		$(".checker-all-{{ $hash }}").prop('checked', false);
	}
}

function getTableCheckedID(hash){
    ids = [];
    $(".checker-" + hash).each(function(){
		if($(this).is(':checked')){
			ids.push($(this).attr('data-id'));
		}
    });
    return ids;
}

function runRemoveBatch{{ $hash }}(){
	//prepare selected ids
    ids = getTableCheckedID('{{ $hash }}');

	if(ids.length > 0){
		$.ajax({
			url : $(".btn-batch-delete").attr('data-href'),
			type : 'POST',
			dataType : 'json',
			data : {
				_token : window.CSRF_TOKEN,
				list_id : ids
			},
			success : function(resp){
				if(resp.type == 'success'){
					toastr.success(resp.message);
					//refresh datatable
					refreshDataTable{{ $hash }}();
				}
				else{
                    // generic success response
                    toastr.success("Data has been deleted successfully");
				}
                $(".checker-all-{{ $hash }}").prop('checked', false);
                $(".batchbox[data-hash='{{ $hash }}']").slideUp();
			},
			error : function(resp){
                errorHandling(resp);
			}
		});			
	}
	else{
		toastr.error('No data selected');
	}
}
</script>