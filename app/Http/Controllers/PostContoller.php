<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostContoller extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostStoreRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
            $data['image'] = Storage::disk('public')->put('/images', $data['image']);
            $data['user_id'] = auth()->user()->id;
            $post = Post::firstOrCreate($data);
            DB::commit();
            return redirect()->route('post.index')->with('message', 'Ваш Пост добавлен успешно');
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }


    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
