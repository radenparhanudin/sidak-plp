<div class="modal fade" id="modalImport" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formModalImport" action="{{ $formAction }}" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $modalTitle ?? "Import Data" }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file_import">File Import</label>
                        <input type="file" class="form-control-file" name="file_import" id="file_import">
                        <div class="invalid-feedback" id="feedback_file_import"></div>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-file-import mr-2"></i>Import</button>
                </div>
            </form>
        </div>
    </div>
</div>