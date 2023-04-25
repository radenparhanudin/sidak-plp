<div class="form-group">
    <select name="opd_id" class="form-control select2" data-placeholder="OPD">
        <option></option>
        @foreach ($opds as $opd)
        <option value="{{ $opd->id }}">{{ $opd->nama }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <textarea name="nip" rows="10" class="form-control" placeholder="NIP ASN"></textarea>
</div>