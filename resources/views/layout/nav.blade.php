
<nav id="sidebar">
    <div class="p-4 pt-5">
        <a href="#" class="img logo rounded-circle mb-5"></a>
        <ul class="list-unstyled components mb-5">
            @guest()
            <li>
                <a  href="{{route('login')}}">Вхід</a>
            </li>
            <li >
                <a href="{{route('register.show')}}">Реєстрація</a>
            </li>
            @endguest
            @auth()
                    @administrator
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('getModSongs')}}">{{__('Керування піснями')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('manageUsers')}}">{{__('Керування акаунтами')}}</a>
                    </li>
                    @endadministrator
                    @moderator
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('getModSongs')}}">{{__('Керування піснями')}}</a>
                    </li>
                    @endmoderator
            <li>
                <a href="{{route('getSavedSong')}}">Збереженні</a>
            </li>
            <li>
                <a href="{{route('getMyAddedSong')}}">Мої додані</a>
            </li>
            <li>
                <a href="{{route('logout')}}">Вихід</a>
            </li>
        @endauth
        </ul>

        <div class="footer">
            <p>
                ©<script>document.write(new Date().getFullYear());</script> site.com All rights reserved
            </p>
        </div>

    </div>
</nav>

<!-- Page Content  -->
<div id="content" class="p-4 p-md-5">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
                <i class="fa fa-bars"></i>
                <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto">
                    <li  class="nav-item active">
                        <a class="nav-link" href="{{route('toHome')}}">Головна</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('add_new_song')}}">Додати розбір</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('getPageArtist')}}">Виконавці</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('getSongPage')}}">Всі пісні</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Категорії</a>
                    </li>
                    <li>
                        <form class="d-flex" action="{{route('search')}}" method="post">
                            @csrf
                            <input class="form-control me-2" type="search" placeholder="Пошук" name="search-value" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Пошук</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
