<form action="{{ $target }}" method="post" class="ajax-form">
	{{ csrf_field() }}
	<div class="form-group">
		<label>Privilege Name</label>
		<input type="text" name="name" class="form-control" placeholder="Ex : Admin" maxlength="50" value="{{ old('name', $data->name) }}" required>
	</div>

	@if(empty($data->id) || !$data->is_sa)
	<div class="form-group">
		<label>Set This Role as Children of</label>
		<?php
		$selected = old('role_owner', $data->role_owner);
		?>
		<select name="role_owner" class="form-control select2">
			<option value="">No Owner</option>
			@foreach($structure->dropdown_list as $id_role => $label_role)
				@if($id_role == 1 || $id_role == $data->id)
					@continue
				@endif
				<option value="{{ $id_role }}" {{ $id_role == $selected ? 'selected' : '' }}>{{ $label_role }}</option>
			@endforeach
		</select>
	</div>
	@endif

    <div class="d-flex justify-content-end">
        <button class="btn btn-primary mr-2">
            <i data-feather="save"></i>
            <span>Save</span>
        </button>

        <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i data-feather="x"></i>
            <span>Cancel</span>
        </button>
    </div>

</form>
