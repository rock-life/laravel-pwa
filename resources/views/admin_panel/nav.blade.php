
<nav id="sidebar">
    <div class="p-4 pt-5">
        <p class="centr-name-user">{{auth()->user()->login}}<p>
        <ul class="list-unstyled components mb-5">
            @auth()
                <li>
                    <a href="{{route('toHome')}}">{{__('menu_items.home_site')}}</a>
                </li>
                <li>
                    <a href="#">{{__('menu_items.role_management')}}</a>
                </li>
                <li>
                    <a href="#">{{__('menu_items.users_management')}}</a>
                </li>
                <li >
                    <a href="#h">{{__('menu_items.application_for_publication')}}</a>
                </li>
                <li>
                    <a href="#">{{__('menu_items.songs_management')}}</a>
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



