<div class="modal fade" id="modalFilterDatatable" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formModalFilterDatatable" action="javascript:void(0)" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-filter mr-2"></i>Filter Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! $modalBody !!}
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-filter mr-2"></i>Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>