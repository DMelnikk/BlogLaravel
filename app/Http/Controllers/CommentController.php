<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
           'name'=>['required','max:255'],
           'comment'=>['required'],
           'post_id'=>['required','exists:posts,id'],
        ]);

        $comment = Comment::query()->create($validated);
        return redirect()->route('posts.single',['slug'=>$comment->post->slug,'#comments']);
//        $validator = Validator::make($request->all(),[
//            'name'=>['required','max:255'],
//            'comment'=>['required'],
//            'post_id'=>['required','exists:posts,id'],
//        ]);
//
//        // возвращает true/false в зависимости если прошли или не прошли валидацию
//        if($validator->fails()) {
//            return redirect()->route('posts.single',['slug'=>])
//        }
//        dump($validator->errors()->all());


    }
}
