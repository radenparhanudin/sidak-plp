<div class="form-group">
    <select name="opd_id" id="opd_id" class="form-control select2" data-placeholder="OPD">
        <option></option>
        @foreach ($opds as $opd)
        <option value="{{ $opd->id }}">{{ $opd->nama }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback" id="feedback_opd_id"></div>
</div>

<div class="form-group">
    <select name="role_name" id="role_name" class="form-control select2" data-placeholder="Role">
        <option></option>
        @foreach ($roles as $role)
        <option value="{{ $role->name }}">{{ $role->description }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback" id="feedback_role_name"></div>
</div>