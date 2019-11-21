<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">electric</a>
        <ul class="navbar-nav justify-content-end">
            @if(Auth::check())
                <li class="nav-item"><a href="#" class="nav-link">用户列表</a></li>
                <li class="nav-item dropdown">
                    <a
                        href="#"
                        class="nav-link"
                        id="navbarDropdown"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        {{Auth::user()->name}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a href="{{route('users.show',Auth::user())}}" class="dropdown-item">
                            个人中心
                        </a>
                        <a href="#" class="dropdown-item">编辑资料</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" id="logout" class="dropdown-item">
                            <form action="{{route('logout')}}" method="post">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
                            </form>
                        </a>
                    </div>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route('help')}}">帮助</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">登录</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
