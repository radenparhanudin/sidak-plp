<div class="modal fade" id="modalPost" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formModalPost" action="{{ $formAction }}" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $modalTitle ?? "Post Data" }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! $modalBody !!}
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-hdd mr-2"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>