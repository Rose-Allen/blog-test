@extends('layouts.header')

@section('content')
    <div class="d-flex justify-content-center" style="width: 100rem;">
            <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label>Заголовок</label>
                    <input type="text" class="form-control" placeholder="Название" name="title">
                    @error('title')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Описание</label>
                    <textarea class="form-control" placeholder="Описание" name="description" ></textarea>
                    @error('description')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label></label><br/>
                    <input type="file" name="image">
                    @error('image')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">

                  <button class="btn btn-primary">Добавить</button>
                </div>

            </form>
    </div>
@endsection
