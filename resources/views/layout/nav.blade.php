
<nav id="sidebar">
    <div class="p-4 pt-5">
        <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(images/logo.jpg);"></a>
        <p class="centr-name-user">Користувач<p>
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

            <li>
                <a href="#">Збережені</a>
            </li>
            <li >
                <a href="#h">Додати розбір</a>
            </li>
            <li>
                <a href="#">Мої додані</a>
            </li>
            <li>
                <a href="#">Відповіді</a>
            </li>
                    <li>
                        <a href="{{'logout'}}">Вихід</a>
                    </li>
                @endauth
        </ul>

        <div class="footer">
            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
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
                    @can('admin_panel',App\Models\User::class)
                        <li class="nav-item">
                            <a class="nav-link" href="#">Панель адміністратора</a>
                        </li>
                    @endcan
                    <li  class="nav-item active">
                        <a class="nav-link" href="#">Головна</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Новинки</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Популярні</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Виконавці</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Усі пісні</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Категорії</a>
                    </li>
                    <li>
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
