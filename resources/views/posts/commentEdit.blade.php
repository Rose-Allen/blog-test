@extends('layouts.header')

@section('content')
    <div class="d-flex justify-content-center" style="width: 100rem;">
        <form action="{{route('comment.update', $comment->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label>Описание</label>
                <div class="mb-3"><textarea class="form-control" name="message" placeholder="Комментарии">{{$comment->message}}</textarea></div>
                @error('message')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label>Изображение</label><br/>
                @if($comment->image)
                    <img src="{{asset('storage/' .$comment->image)}}" width="100ppx" height="100px" alt="">
                @else
                    <h4>Нету фотки</h4>
                @endif
                <input type="file" name="image">
                @error('image')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">

                <button class="btn btn-primary">Добавить</button>
            </div>
            <div class="mb-3">
                <a href="{{route('comment.image.destroy', $comment->id)}}" class="btn btn-danger">Удалить фотку</a>
            </div>

        </form>
    </div>
@endsection
