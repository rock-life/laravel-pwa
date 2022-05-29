@extends('layout.header')

@section('content')
    <div class="container song-add-container">
        <input type="hidden" id="categ" value="{{$cat}}">
        <div class="content-song">
            <div class="header-content header-content-song">
                <span>
                    <a>{{$namePage}} </a>
                </span>
            </div>
            <div class="songs-show">
                <table id="songs-list">
                    <tr>
                        <td>Виконавець</td>
                        <td width="50%">Пісня</td>
                        <td></td>
                    </tr>
                    @foreach($songs as $song)
                        <tr>
                            <td><a href="{{route('songsArtist', ['id' => $song['artistId']])}}">{{$song['artistName']}}</a></td>
                            <td width="50%" ><a href="{{route('getSongShow', ['id_song' => $song['id'], 'id_song_variant' => $song['variantId'], 'type' => $song['id_form_of_writing']])}}">{{$song['name']}}</a></td>
                            <td ><a value="{{$song['id_form_of_writing']}}">{{$song['name_form_of_writing']}}</a></td>
                        </tr>
                    @endforeach
                </table>
                <div class="footer-action-page-song">
                    <div class="footer-action-buttons">
                        <input type="hidden" id="next-page" page="0">
                        <button id="pre-songsC" class="form-control footer-action-button">Попередня</button>
                        <button id="next-songsC" class="form-control footer-action-button">Наступна</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection()
