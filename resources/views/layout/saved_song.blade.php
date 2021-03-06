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
            </div>
            <div class="song-show">
                <table>
                    <tr>
                        <td>Виконавець</td>
                        <td>Пісня</td>
                        <td></td>
                    </tr>
                    @foreach($songs as $song)
                        <tr>
                            <td><a href="{{route('songsArtist', ['id' => $song->id_artist])}}">{{$song->artist}}</a></td>
                            <td><a href="{{route('getSongShow', ['id_song' => $song->id])}}">{{$song->name}}</a></td>
                            <td> <input type="button"  class="form-control footer-action-button" id="delete-saved" id_song="{{$song->id}}" value="Видалити зі списку"/> </td>
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
