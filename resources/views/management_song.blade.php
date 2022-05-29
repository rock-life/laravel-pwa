@extends('layout.header')

@section('content')
    <div class="container song-add-container">
        <div class="content-song">
            <div class="header-content header-content-song">
               <span>
                Керування піснями
                </span>
            </div>
            <div class="songs-show">
                <table id="songs-show">
                    <tr>
                        <td>Виконавець</td>
                        <td>Пісня</td>
                        <td>Опубліковано</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach($songs as $song)
                        <tr>
                            <td><a href="{{route('songsArtist', ['id' => $song['artistId']])}}">{{$song['artist']}}</a></td>
                            <td ><a href="{{route('getSong', ['id_song' => $song['id'], 'id_song_variant' => $song['variantId'], 'type' => $song['form_of_writingId']])}}">{{$song['name']}}</a></td>
                            @if($song['visibility'])
                                <td> <input class="visibility" value="{{$song['variantId']}}" type="checkbox" checked/> </td>
                            @else
                                <td> <input class="visibility" value="{{$song['variantId']}}" type="checkbox" /> </td>
                            @endif
                            <td> {{$song['form_of_writing']}} </td>
                            <td> <input type="button"  class="form-control footer-action-button delete" id_song="{{$song['variantId']}}" value="Видалити"/> </td>
                            <td> <a href="{{route('editSongPage', ['id' => $song['variantId']])}}" class="form-control footer-action-button" id_song="{{$song['variantId']}}" > Редагувати </a> </td>
                        </tr>
                    @endforeach
                </table>
                <div class="footer-action-page-song">
                    <div class="footer-action-buttons">
                        <input type="hidden" id="next-page" page="0">
                        <button id="pre-page-manageM"  class="form-control footer-action-button" >Попередня</button>
                        <button id="next-page-manageM" class="form-control footer-action-button" page="1">Наступна</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection()
