<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('admin.dashboard')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('member.index')}}">Member</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('saving.index')}}">Daily Saving</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <span class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="margin-right:100px;" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{auth()->user()->name}}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('auth.logout')}}">Logout</a></li>
                    </ul>
                </span>
            </form>
        </div>
    </div>
</nav>