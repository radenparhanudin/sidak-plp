@hasanyrole('adminopd|adminbkd')
<li class="nav-header text-uppercase">Absensi</li>
@endhasrole
@hasrole('adminopd')
<li class="nav-item">
    <a href="{{ route('absensi.asn.index') }}" class="nav-link {{ set_active('absensi.asn.index') }}">
        <i class="nav-icon fas fa-hand-point-up"></i>
        <p>ASN</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('absensi.tim-sidak.index') }}" class="nav-link {{ set_active('absensi.tim-sidak.index') }}">
        <i class="nav-icon far fa-hand-point-up"></i>
        <p>Tim Sidak</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('absensi.upload-file.index') }}" class="nav-link {{ set_active('absensi.upload-file.index') }}">
        <i class="nav-icon fas fa-cloud-upload-alt"></i>
        <p>Upload File</p>
    </a>
</li>
@endhasrole