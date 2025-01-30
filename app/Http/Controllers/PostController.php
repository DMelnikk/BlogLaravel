<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index()
    {
        // First method caching data
//        Cache::put('test', 'Test str', 40);
//        dump(Cache::get('test'));
//        dump(date('Y-m-d H:i:s',time()));
//        dump(date('Y-m-d H:i:s',time()));
        // Second method caching data
//        cache()->put('test2', 'Hello');


        $posts = Post::with('category')->orderBy('id','desc')->paginate(2);
        return view('post.index',compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::query()->where('slug','=',$slug)->firstOrFail();
        // получаем экземпляр поста и увеличиваем его на 1 , и сразу же обновляем просмотры
        $post->views +=1;
        $post->update();

        // fragment работает так , что при клике на новую страницу в пагинации , он сразу же перебрасывает на комментарии , в blade шаблонизаторе нужно добавить id = comments
        $comments = $post->comments()->latest()->paginate(2)->fragment('comments');

        // вытаскиваем похожие посты , но кроме нашего
        $related_posts = Post::query()
            ->where('category_id','=',$post->category_id)
            ->where('id','!=',$post->id)
            ->limit(2)
            ->get();

        return view('post.show',compact('post','related_posts','comments'));
    }

    public function search(Request $request)
    {
        // withQueryString сохраняет get параметры
        $posts = Post::query()->whereLike('title','%'. $request->search .'%')->with('category')->paginate(2)->withQueryString();
        return view('post.search',compact('posts'));
    }
}
