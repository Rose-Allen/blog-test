@extends('layouts.header')

@section('content')
    <div class="container">
        @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="card" style="width: 24rem;">
                    <img src="{{asset('storage/'.$post->image)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">{{$post->description}}</p>
                    </div>
                    @auth()
                    <div class="card-footer">
                        <form action="{{route('comment.store', $post->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3"><textarea class="form-control" name="message" placeholder="Комментарии"></textarea></div>
                            <div class="mb-3"><input type="file" name="image"></div>
                            <div class="mb-3"><button class="btn btn-success">Отправить</button></div>
                        </form>
                    </div>
                    @endauth
                    <input type="hidden" value="{{$post->id}}">
                    <section class="comment-list mb-5">
                        <h2 class="section-title mb-5" data-aos="fade-up">Комментарии ({{$post->comments->count()}}
                            )</h2>
                        @foreach($post->comments as $comment)
                            <div class="card card-body shadow-sm mt-3">
                                <div class="detail-area">
                                    <span class="text-muted float-right">{{$comment->DataAsCarbon->diffForHumans()}}</span>
                                    <h6 class="user-name mb-1">{{$comment->user->name}}</h6>
                                    <p class="user-comment mb-1">
                                        {{$comment->message}}
                                    </p>

                                    @if($comment->image)
                                        <img src="{{asset('storage/'.$comment->image)}}" width="100px" height="100px" class="mt-3 mb-3" alt="">
                                    @endif
                                </div>
                                <div>
                                    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::id() == $comment->user_id)
                                    <a href="{{route('comment.edit', $comment->id)}}" class="btn btn-primary btn-sm me-2">Редактировать</a>
                                    <a href="{{route('comment.destroy', $comment->id)}}" class="btn btn-danger btn-sm me-2">Удалить</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </section>
                </div>

{{--                <div class="card card-body shadow-sm mt-3">--}}
{{--                    <div class="detail-area">--}}
{{--                        <h6 class="user-name mb-1">{{$comment->user->name}}</h6>--}}
{{--                        <p class="user-comment mb-1">--}}
{{--                            {{$comment->message}}--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <a href="" class="btn btn-primary btn-sm me-2">Редактировать</a>--}}
{{--                        <a href="" class="btn btn-danger btn-sm me-2">Удалить</a>--}}
{{--                    </div>--}}
{{--                </div>--}}




{{--                <div class="card">--}}
{{--                    @foreach($post->comments as $comment)--}}
{{--                        {{$comment->user->name}}--}}
{{--                    @endforeach--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
@endsection
