@extends('layout.header')

@section('content')
    <input type="hidden" id="idSong" value="{{$idSong}}">
    <input type="hidden" id="idSongVariant" value="{{$songDetail['id']}}">
    <div class="container song-add-container">
        <div class="content-song">
            <div class="header-content header-content-song">
               <span>
                Керування піснями
                </span>
                <div>
                    <form class="d-flex" action="{{route('searchUsers')}}" method="post">
                        @csrf
                        <input class="form-control me-2" type="search" placeholder="Пошук" name="search-value" title="Пошук по логіну або email" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Пошук</button>
                    </form>
                </div>
            </div>
            <div class="song-show">
                <table>
                    <tr>
                        <td>Логін</td>
                        <td>Пошта</td>
                        <td>Роль</td>
                        <td></td>
                    </tr>
                    @foreach($users as $user)
                        <tr>
                            <td><input type="hidden" id="id_user" value="{{$user->id}}"><a >{{$user->login}}</a></td>
                            <td><a >{{$user->email}}</a></td>
                            <td> <select id="role">
                                    @if($user->roleId == 1)
                                        <option value="1" selected>Користувач</option>
                                        <option value="2" >Модератор</option>
                                    @elseif($user->roleId == 2)
                                        <option value="1" >Користувач</option>
                                        <option value="2" selected>Модератор</option>
                                    @endif
                                </select>
                            </td>
                            @administrator
                            <td> <input type="button"  class="form-control footer-action-button" id="delete" id_song="{{$song->id}}" value="Видалити"/> </td>
                            @endadministrator
                        </tr>
                    @endforeach
                </table>
                <div class="footer-action-page-song">
                    <div class="footer-action-buttons">
                        <button id="pre-page-manage"  class="form-control footer-action-button" >Попередня</button>
                        <button id="next-page-manage" class="form-control footer-action-button" page="1">Наступна</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection()
