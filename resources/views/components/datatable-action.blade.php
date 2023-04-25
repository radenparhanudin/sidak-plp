@if (isset($actions) AND count($actions) > 0)
<button type="button" class="btn btn-primary btn-sm" data-toggle="dropdown"><i class="fas fa-bars mr-2"></i>Aksi</button>
<div class="dropdown-menu dropdown-menu-right" role="menu">
    @if (isset($actions['edit']) AND $actions['edit']['show'])
    <a href="{{ $actions['edit']['href'] }}" class="dropdown-item btn-edit"><i class="fas fa-edit mr-2"></i>Edit</a>
    @endif
    @if (isset($actions['delete']) AND $actions['delete']['show'])
    <a href="{{ $actions['delete']['href'] }}" class="dropdown-item btn-delete"><i class="fas fa-trash mr-2"></i>Hapus</a>
    @endif
</div>
@endif