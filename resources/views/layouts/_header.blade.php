<nav class="navbar navbar-expand-lg navbar-light bg-light shadow mb-4" style="height: 60px">
    <span class="navbar-brand mr-auto ml-lg-5">Laravel Forum</span>
    <div class="collapse navbar-collapse ml-4" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('topics')) ? 'active' : '' }}"
                   href="{{ route('topics.index', ['order' => 'last_replied']) }}">Topics</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('categories/1')) ? 'active' : '' }}"
                   href="{{ route('categories.show', ['order' => 'last_replied', 'category' => '1']) }}">Shares</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('categories/2')) ? 'active' : '' }}"
                   href="{{ route('categories.show', ['order' => 'last_replied', 'category' => '2']) }}">Tutorials</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('categories/3')) ? 'active' : '' }}"
                   href="{{ route('categories.show', ['order' => 'last_replied', 'category' => '3']) }}">Q&A</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('categories/4')) ? 'active' : '' }}"
                   href="{{ route('categories.show', ['order' => 'last_replied', 'category' => '4']) }}">Announcement</a>
            </li>
        </ul>
    </div>
    @guest()
        <ul class="navbar-nav mr-5">
            <li class="nav-link">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-link">
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
        </ul>
    @else
        <ul class="navbar-nav mr-5">
            <li class="nav-link dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="mr-2" src="{{ Auth::user()->avatar }}" alt="" style="height: 30px; width: 30px">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('users.show', Auth::user()) }}">
                        <i class="far fa-user mr-1"></i>
                        User Center
                    </a>
                    <a class="dropdown-item" href="{{ route('users.edit', Auth::id()) }}">
                        <i class="fas fa-edit mr-1"></i>
                        Edit Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-item" href="#">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="btn btn-block btn-danger" type="submit" href="#">Log out</button>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    @endguest
</nav>
