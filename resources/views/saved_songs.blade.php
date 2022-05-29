@extends('layout.header')

@section('content')
    <div class="container song-add-container">
        <div class="content-song">
            <div class="header-content header-content-song">
            </div>
            <div class="songs-show">
                <table id="songs-list">
                    <tr>
                        <td>Виконавець</td>
                        <td width="50%">Пісня</td>
                    </tr>
                    @if( !empty($songs))
                    @foreach($songs as $song)
                        <tr>
                            <td><a href="{{route('songsArtist', ['id' => $song['artistId']])}}">{{$song['artist']}}</a></td>
                            <td ><a href="{{route('getSong', ['id_song' => $song['id'], 'id_song_variant' => $song['id_song_variant'], 'type' => $song['id_form_of_writing']])}}">{{$song['name']}}</a></td>
                            <td >{{$song['form_of_writing']}}</td>
                        </tr>
                    @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>

@endsection()
