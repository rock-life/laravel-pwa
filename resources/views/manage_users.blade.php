@extends('layout.header')

@section('content')

    <div class="container song-add-container">
        <div class="content-song">
            <div class="header-content header-content-song">
               <span>
                Керування користувачами
                </span>
                <div>
                </div>
            </div>
            <div class="songs-show">
                <table  id="songs-list">
                    <tr>
                        <td>Логін</td>
                        <td>Пошта</td>
                        <td>Роль</td>
                        <td></td>
                    </tr>
                    @foreach($users as $user)
                        <tr>
                            <td><input type="hidden" id="id_user" value="{{$user['id']}}"><a >{{$user['login']}}</a></td>
                            <td><a >{{$user['email']}}</a></td>
                            <td> <select class="role">
                                    @if($user['roleId'] == 1)
                                        <option id_user="{{$user['id']}}" value="1" selected>Користувач</option>
                                        <option id_user="{{$user['id']}}" value="2" >Модератор</option>
                                    @elseif($user['roleId'] == 2)
                                        <option id_user="{{$user['id']}}" value="1" >Користувач</option>
                                        <option id_user="{{$user['id']}}" value="2" selected>Модератор</option>
                                    @endif
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="footer-action-page-song">
                    <div class="footer-action-buttons">
                        <input type="hidden" id="next-page" page="0">
                        <button id="pre-page-manageU"  class="form-control footer-action-button" >Попередня</button>
                        <button id="next-page-manageU" class="form-control footer-action-button">Наступна</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection()
