@push('plugins-style')
<link rel="stylesheet" href="{{ asset('template/backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
@endpush
@push('plugins-script')
<script src="{{ asset('template/backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function(){
        $.extend( DataTable.ext.classes, {
            sFilterInput:  "form-control",
            sLengthSelect: "form-select dt-select2",
        });

        $.extend($.fn.dataTable.defaults, {
            processing: true,
            serverSide: true,
            search: {
                return: true,
            },
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Pencarian . . .",
                lengthMenu: "_MENU_",
            },
            drawCallback: function() {
                $('.dt-select2').select2({
                    width: "70px",
                    minimumResultsForSearch: Infinity
                });
            }
        });

        $('#dataTable').on('click', '.btn-delete', function (event) {
            event.preventDefault();
            Swal.fire({
                icon: 'warning',
                html: 'Apakah anda yakin menghapus data ini?',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Tidak!',
                backdrop: false,
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: $(this).attr('href'),
                        type: 'DELETE',
                        beforeSend: function () {
                            $('body').loadingModal({
                                backgroundColor: 'rgb(62, 142, 247)',
                                animation: 'cubeGrid'
                            });
                        },
                        success: function (res) {
                            $('body').loadingModal('destroy')
                            $('#dataTable').DataTable().ajax.reload(null, false);
                            if(res.status){
                                notyf.success(res.message)
                            }else{
                                notyf.error(res.message)
                            }
                        }
                    })
                }
            })
        });
    })
</script>
@endpush