<div class="form-group">
    <select name="opd_id" id="opd_id" class="form-control select2" data-placeholder="OPD">
        <option></option>
        @foreach ($opds as $opd)
        <option value="{{ $opd->id }}">{{ $opd->nama }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback" id="feedback_opd_id"></div>
</div>