@extends('layouts.app')

@section('content')
<div class="content pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h5 class="m-0 align-self-center"><i class="fas fa-users mr-2"></i>Absensi ASN</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="dataTable" class="table table-bordered table-striped w-100">
                            <thead>
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>KET.</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('components.modal-post',[
    'formAction' => "javascript:void(0)",
    'modalTitle' => 'Update Keterangan',
    'modalBody' => view('absensi::asn.form-post'),
])
@endsection
@include('components.datatable')
@include('components.select2')
@push('script')
<script>
    $(document).ready(function(){
        let dataTable = $('#dataTable').DataTable({
            ajax: "{{ route('absensi.asn.datatable') }}",
            columns: [
                {data: 'nip_baru', name: 'nip_baru'},
                {data: 'nama', name: 'nama'},
                {data: 'keterangan', name: 'keterangan', className:'text-nowrap text-center w-5'},
                {data: 'action', name: 'action', className:'text-nowrap text-center w-5'},
            ],
            order: [[2, 'asc'], [1, 'asc']]
        })

        $('#dataTable').on('click', '.btn-edit', function (event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('href'),
                beforeSend: function () {
                    $('body').loadingModal({
                        backgroundColor: 'rgb(62, 142, 247)',
                        animation: 'cubeGrid'
                    });
                },
                success:function (res) {
                    $('body').loadingModal('destroy')
                    if(res.status){
                        let result = res.results[0];
                        $('#formModalPost').attr({
                            'action' : result.action, 
                            'method': 'PUT'
                        })
                        $('#opd_id').val(result.opd_id).trigger('change')
                        $('#role_name').val(result.role_name).trigger('change')

                        $('#modalPost').modal('show')
                    }else{
                        notyf.error(res.message)
                    }
                }
            })
        });
    })
</script>
@endpush