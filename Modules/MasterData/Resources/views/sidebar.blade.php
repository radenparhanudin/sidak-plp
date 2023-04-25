@hasanyrole('administrator|adminbkd')
<li class="nav-header text-uppercase">Data Master</li>
@hasrole('administrator')
<li class="nav-item">
    <a href="{{ route('opd.index') }}" class="nav-link {{ set_active('opd.index') }}">
        <i class="nav-icon fas fa-building"></i>
        <p>OPD</p>
    </a>
</li>
@endhasrole
<li class="nav-item">
    <a href="{{ route('asn.index') }}" class="nav-link {{ set_active('asn.index') }}">
        <i class="nav-icon fas fa-users"></i>
        <p>ASN</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('tim-sidak.index') }}" class="nav-link {{ set_active('tim-sidak.index') }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Tim Sidak</p>
    </a>
</li>
@endhasanyrole