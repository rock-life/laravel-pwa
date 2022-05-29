@extends('layout.header')

@section('content')
    <div class="container song-add-container">
        <div class="content-song">
            <div class="header-content header-content-song">
               <span>
                Мої додані пісні
                </span>
            </div>
            <div class="songs-show">
                <table id="songs-list">
                    <tr>
                        <td>Виконавець</td>
                        <td>Пісня</td>
                        <td></td>
                        <td></td>
                    </tr>
                    @if( !empty($result) )
                        @foreach($result as $song)
                            <tr>
                                <td><a href="{{route('songsArtist', ['id' => $song['artistId']])}}">{{$song['nameArtist']}}</a></td>
                                <td ><a href="{{route('getSong', ['id_song' => $song['id'], 'id_song_variant' => $song['song_variantId'], 'type' => $song['form_of_writingId']])}}">{{$song['name']}}</a></td>
                                <td width="10%"> <a href="{{route('editSongPage', ['id' => $song['song_variantId']])}}" class="form-control footer-action-button" id_song="{{$song['song_variantId']}}" > Редагувати </a> </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
                <div class="footer-action-page-song">
                    <div class="footer-action-buttons">
                        <input type="hidden" id="next-page" page="0">
                        <button id="pre-page-manage"  class="form-control footer-action-button" >Попередня</button>
                        <button id="next-page-manage" class="form-control footer-action-button" page="1">Наступна</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection()
