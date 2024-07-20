<a class="dropdown-item" href="{{ route('logout') }}"
    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
    <i class="ti ti-logout me-2 ti-sm"></i>
    <span class="align-middle">Log Out</span>
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
