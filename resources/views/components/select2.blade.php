@push('plugins-style')
<link rel="stylesheet" href="{{ asset('template/backend') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('template/backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@push('plugins-script')
<script src="{{ asset('template/backend') }}/plugins/select2/js/select2.full.min.js"></script>
<script>
    $(document).ready(function(){
        $('.select2').select2()
        $('.select2-allowClear').select2({
            allowClear: true
        })
        $('.select2-infinity').select2({
            minimumResultsForSearch: Infinity
        });
        $('.select2-infinity-allowClear').select2({
            minimumResultsForSearch: Infinity,
            allowClear: true
        });
    })
</script>
@endpush