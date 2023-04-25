@hasrole('administrator')
<li class="nav-header text-uppercase">Administrator</li>
<li class="nav-item">
    <a href="{{ route('user.index') }}" class="nav-link {{ set_active('user.index') }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Data Pengguna</p>
    </a>
</li>
@endhasrole