@extends('layouts.app')

@section('content')
<div class="content pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h5 class="m-0 align-self-center"><i class="fas fa-users mr-2"></i>Data ASN</h5>
                        <button class="btn btn-primary ml-auto" data-toggle="modal" data-target="#modalDownload"><i class="fas fa-cloud-download-alt mr-2"></i>Download</button>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="dataTable" class="table table-bordered table-striped w-100">
                            <thead>
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>OPD</th>
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
                {data: 'opd', name: 'opd.nama'},
            ],
        })
    })
</script>
@endpush