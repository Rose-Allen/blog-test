@extends('layouts.header')
@section('content')
    <div class="container">
        @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <a href="{{route('post.create')}}" class="btn btn-success mb-5">Добавить Пост</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Заголовок</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td>{{$post->title}}</td>
                    <td><a href="{{route('myPost.edit', $post->id)}}" class="btn btn-primary">Изменить</a>
                        <a href="{{route('myPost.destroy', $post->id)}}" onclick="return confirm('Вы действительно хотите удалить эту запиись?')" class="btn btn-danger">Удалить</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
