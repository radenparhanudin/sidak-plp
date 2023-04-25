@hasrole('adminopd')
<li class="nav-header text-uppercase">Register</li>
<li class="nav-item">
    <a href="{{ route('register.asn.index') }}" class="nav-link {{ set_active('register.asn.index') }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Data ASN</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('register.tim-sidak.index') }}" class="nav-link {{ set_active('register.tim-sidak.index') }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Tim Sidak</p>
    </a>
</li>
@endhasrole