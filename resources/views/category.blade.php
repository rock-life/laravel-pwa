@extends('layout.header')

@section('content')
    <div class="container song-add-container">
        <div class="content-song">
            <div class="header-content header-content-song">
                <span>
                    <a>Усі категорії </a>
                </span>
            </div>
            <div class="songs-show">
                <table id="songs-list">
                    @foreach($categorys as $song)
                        <tr>
                            <td><a href="{{route('songsCategory', ['id' => $song['id']])}}">{{$song['name']}}</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection()
