@extends (request()->ajax() ? 'cms.layouts.blank' : 'cms.layouts.master')

@push ('style')
<style>
.priviledge-check label{
    background:#eee;
    padding:.1em .4rem;
    border-radius: 5px;
}
.priviledge-check.active label{
    background:#5f63f2;
    color:#fff;
}
</style>
@endpush

@section ('content')
<div class="breadcrumb-main">
    <h4 class="text-capitalize breadcrumb-title">Manage Permission</h4>
</div>
<div class="mb-3">
	<div class="action-btn">
		<a data-target="{{ route('cms.create-permission') }}" href="#" data-action="add" class="btn btn-primary">+ Add New Permission</a>
	</div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-privilege">
            <thead>
                <tr>
                    <th>Privilege Name</th>
                    <th class="hide-on-mobile"></th>
                    <th class="hide-on-mobile"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($role_structure->role_list as $row)
                <tr class="close-target">
                    <td>{{ str_repeat('-', $row['level']) }} {{ $row['label'] }}</td>
                    <td>
                        @if($row['is_sa'])
                        <div>
                            <small>This privilege has <strong>all</strong> permission</small>
                        </div>
                        @else
                            <a href="#" data-target="{{ route('cms.manage-permission', ['id' => $row['id']]) }}" data-action="add" class="btn btn-sm btn-primary">Manage Privileges ({{ count($row['priviledge_list']) }})</a>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            @if(!$row['is_sa'])
                            <a href="#" data-target="{{ route('cms.edit-permission', ['id' => $row['id']]) }}" data-action="add" class="btn btn-light text-primary" title="Edit"><span data-feather="edit-2"></span> Edit</a>
                            <a href="#" data-target="{{ route('cms.delete-permission', ['id' => $row['id']]) }}" class="btn btn-light text-danger delete-button" title="Delete"><span data-feather="trash-2"></span> Delete</a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@push ('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="privilege-crud" data-backdrop="static">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Manage Privilege</h5>
				<button type="button" class="close btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

			</div>
		</div>
	</div>
</div>
@endpush

@push ('script')
<script>
$(function(){
	$("[data-action='add']").on('click', function(e){
		e.preventDefault();
		loadPrivilegeCrud($(this).attr('data-target'));
	});

	$(document).on('change', '.priviledge-check input[type=checkbox]', function(){
		inputCheckEvent($(this));
		groupCheckCondition();
	});

	$(document).on('change', '.group-checkbox', function(){
		items = $(this).closest('td').next('td').find('.priviledge-check');
		condition = $(this).is(':checked');
		$.each(items, function(){
			$(this).find('input[type=checkbox]').prop('checked', condition).change();
		});
	});

});

function loadCheckEvent(){
	$(".priviledge-check").each(function(){
		input = $(this).find('input[type=checkbox]');
		inputCheckEvent(input);
	});
	groupCheckCondition();
}

function groupCheckCondition(){
	$(".group-checkbox").each(function(){
		items = $(this).closest('td').next('td').find('.priviledge-check');
		cond = true;
		$.each(items, function(){
			cond = cond && $(this).find('input[type=checkbox]').prop('checked');
		});

		if(cond == true){
			$(this).prop('checked', true);
		}
		else{
			$(this).prop('checked', false);
		}
	});
}

function inputCheckEvent(input){
	paren = input.closest('.priviledge-check');
	if(input.is(':checked')){
		paren.addClass('active');
	}
	else{
		paren.removeClass('active');
	}
}


function loadPrivilegeCrud(target){
	showLoading();
	$.ajax({
		url : target,
		type : 'GET',
		dataType : 'html',
		success : function(resp){
			hideLoading();
			$("#privilege-crud").modal('show');
			$("#privilege-crud .modal-body").html(resp);
			initPlugins();
		},
		error : function(resp){
			errorHandling(resp);
		}
	});
}
</script>
@endpush