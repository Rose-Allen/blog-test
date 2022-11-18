<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MyPostsController extends Controller
{
    public function index(User $user)
    {
        $posts = auth()->user()->posts;
        return view('myPosts.index', compact('posts'));
    }


    public function edit(Post $post)
    {
        return view('myPosts.edit', compact('post'));
    }

    public function update(Post $post, PostUpdateRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')){
            $data['image'] = Storage::disk('public')->put('/images', $data['image']);
        }
        $post->update($data);
        return redirect()->route('myPost.index')->with('message', 'Пост Успешно Обновлен');
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            if (File::exists($post->image)) {
                File::delete($post->image);
            }
        }
        $post->delete();
        return redirect()->back()->with('message', 'Пост Успешно удален');
    }
}
