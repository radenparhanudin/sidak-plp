@extends('layouts.app')

@section('content')
<div class="content pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h5 class="m-0 align-self-center"><i class="fas fa-users mr-2"></i>Data ASN</h5>
                        @hasrole('administrator')
                        <button class="btn btn-primary ml-auto" data-toggle="modal" data-target="#modalDownload"><i class="fas fa-cloud-download-alt mr-2"></i>Download</button>
                        @endhasrole
                    </div>
                    <div class="card-body table-responsive">
                        <table id="dataTable" class="table table-bordered table-striped w-100">
                            <thead>
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>KET.</th>
                                    <th>OPD</th>
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
@include('components.modal-download',[
    'formAction' => route('asn.download'),
    'modalBody' => view('masterdata::asn.form-download', compact('opds')),
])

@include('components.modal-post',[
    'formAction' => 'javascript:void(0)',
    'modalTitle' => 'Update OPD',
    'modalBody' => view('masterdata::asn.form-post', compact('opds')),
])
@endsection
@include('components.datatable')
@include('components.select2')
@push('script')
<script>
    $(document).ready(function(){
        let dataTable = $('#dataTable').DataTable({
            ajax: "{{ route('asn.datatable') }}",
            columns: [
                {data: 'nip_baru', name: 'nip_baru'},
                {data: 'nama', name: 'nama'},
                {data: 'keterangan', name: 'keterangan', className:'text-nowrap text-center w-5'},
                {data: 'opd', name: 'opd.nama'},
                {data: 'action', name: 'action', className:'text-nowrap text-center w-5'},
            ],
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