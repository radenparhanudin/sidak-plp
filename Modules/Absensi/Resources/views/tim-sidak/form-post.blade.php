@php
    $keterangan = [
        'H' => 'Hadir', 
        'TK' => 'Tanpa Keterangan', 
        'S' => 'Sakit', 
        'I' => 'Izin', 
        'C' => 'Cuti', 
];
@endphp
<div class="form-group">
    <select name="keterangan" id="keterangan" class="form-control select2" data-placeholder="Keterangan">
        <option></option>
        @foreach ($keterangan as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback" id="feedback_keterangan"></div>
</div>
