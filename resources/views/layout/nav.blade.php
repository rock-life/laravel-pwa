
<nav id="sidebar">
    <div class="p-4 pt-5">
        <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(images/logo.jpg);"></a>
        <ul class="list-unstyled components mb-5">
            @guest()
            <li>
                <a  href="{{route('login',['uk'])}}">{{__('menu_items.sign_in')}}</a>
            </li>
            <li >
                <a href="{{route('register.show',['uk'])}}">{{__('menu_items.register')}}</a>
            </li>
                @endguest
                @auth()
            <li>
                <a href="#">{{__('menu_items.saved_songs')}}</a>
            </li>
            <li >
                <a href="#">{{__('menu_items.add_song')}}</a>
            </li>
            <li>
                <a href="#">{{__('menu_items.my_song_book')}}</a>
            </li>
                    <li>
                        <a href="{{'logout'}}">{{__('menu_items.logout')}}</a>
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
                            <a class="nav-link" href="{{route('admin_panel')}}">{{__('menu_items.admin_panel')}}</a>
                        </li>
                    @endcan
                    <li  class="nav-item active">
                        <a class="nav-link" href="{{route('toHome')}}">{{__('menu_items.home')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{__('menu_items.new_song')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{__('menu_items.popular_songs')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{__('menu_items.artists')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{__('menu_items.all_songs')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{__('menu_items.category')}}</a>
                    </li>
                    <li>
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">{{__('menu_items.search')}}</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
