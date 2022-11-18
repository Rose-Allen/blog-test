<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CommentController extends Controller
{
    public function store(Post $post, CommentStoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['post_id'] = $post->id;
        if ($request->hasFile('image')) {
            $data['image'] = Storage::disk('public')->put('/comment', $data['image']);
        }
        Comment::create($data);
        return redirect()->route('post.show', $post->id);
    }

    public function edit(Comment $comment)
    {
        return view('posts.commentEdit', compact('comment'));
    }

    public function update(Comment $comment, CommentUpdateRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')){
            $data['image'] = Storage::disk('public')->put('/images', $data['image']);
        }
        $comment->update($data);
        return redirect()->route('post.index')->with('message', 'Комментарии изменен');
    }

    public function destroy(Comment $comment, Post $post)
    {
        if (File::exists($comment->image)) {
            File::delete($comment->image);
        }
        $comment->delete();
        return redirect()->back()->with('message', 'Ваш комментарии успешно удален');
    }

}
