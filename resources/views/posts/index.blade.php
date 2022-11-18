@extends('layouts.header')
@section('content')
    @auth()
    <div class="d-flex justify-content-end">
        <a href="{{route('post.create')}}" class="btn btn-primary">Добавить Пост</a>
    </div>
    @endauth
    @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
    @endif
    <div class="container">
        <div class="row">
            @foreach($posts as $post)
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <img src="{{asset('storage/'.$post->image)}}" width="200x" height="150px" style="text-align: center" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
{{--                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>--}}
                        <a href="{{route('post.show', $post->id)}}" class="btn btn-primary">Подробнее</a>
                    </div>
                </div>
            </div>
            @endforeach
{{--            <div class="col-md-3">--}}
{{--                <div class="card" style="width: 18rem;">--}}
{{--                    <img src="..." class="card-img-top" alt="...">--}}
{{--                    <div class="card-body">--}}
{{--                        <h5 class="card-title">Card title</h5>--}}
{{--                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>--}}
{{--                        <a href="#" class="btn btn-primary">Go somewhere</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-3">--}}
{{--                <div class="card" style="width: 18rem;">--}}
{{--                    <img src="..." class="card-img-top" alt="...">--}}
{{--                    <div class="card-body">--}}
{{--                        <h5 class="card-title">Card title</h5>--}}
{{--                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>--}}
{{--                        <a href="#" class="btn btn-primary">Go somewhere</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection
