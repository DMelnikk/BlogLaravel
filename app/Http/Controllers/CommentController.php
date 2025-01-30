<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request)
    {
//        $validated = $request->validate([
//           'name'=>['required','max:255'],
//           'comment'=>['required'],
//           'post_id'=>['required','exists:posts,id'],
//        ]);
        $validator = Validator::make($request->all(),[
            'name'=>['required','max:255'],
            'comment'=>['required'],
            'post_id'=>['required','exists:posts,id'],
        ]);
        if($validator->fails()) {
           $errors = '<ul>';
           foreach ($validator->errors()->all() as $error) {
               $errors .= '<li>'.$error.'</li>';
           }
           $errors .= '</ul>';
           return response()->json([
              'status'=>'error',
               'data'=>$errors,
           ]);
        }


        $comment = Comment::query()->create($validator->validated());
        return response()->json([
            'status'=>'success',
            'data'=>'Comment added successfully',
            // возвращаем статус success/error и html
            'comment'=> view('comment.new-comment',compact('comment'))->render(),
        ]);

      //   return redirect()->route('posts.single',['slug'=>$comment->post->slug,'#comments']);

//
//        // возвращает true/false в зависимости если прошли или не прошли валидацию
//
//        dump($validator->errors()->all());


    }
}
