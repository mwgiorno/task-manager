<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand" href="#">Task Manager</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link @if(request()->routeIs('lists')) active @endif" aria-current="page" href="{{ route('lists') }}">My Lists</a>
          </li>
        </ul>
        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <a class="btn btn-outline-primary" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </a>
        </form>
      </div>
    </div>
</nav>