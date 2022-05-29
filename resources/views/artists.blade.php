@extends('layout.header')

@section('content')
    <div class="container song-add-container">
        <div class="content-song">
            <div class="header-content header-content-song">
                <span>
                    <a>{{$namePage}} </a>
                </span>
            </div>
            <div class="songs-show">
                <table id="songs-list">
                    @foreach($artists as $song)
                        <tr>
                            <td><a href="{{route('songsArtist', ['id' => $song['id']])}}">{{$song['name']}}</a></td>
                        </tr>
                    @endforeach
                </table>
                <div class="footer-action-page-song">
                    <div class="footer-action-buttons">
                        <input type="hidden" id="next-page" page="0">
                        <button id="pre-artist" class="form-control footer-action-button">Попередня</button>
                        <button id="next-artist" class="form-control footer-action-button">Наступна</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection()
