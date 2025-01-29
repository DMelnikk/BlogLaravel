<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Nette\Utils\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Pagination\Paginator::useBootstrapFive();

        // мы делимся данными для нашего сайдбара
        // первый способ
        view()->composer('layouts.sidebar', function (\Illuminate\View\View $view) {
            $view->with('popular_posts',Post::query()->orderBy('views','desc')->limit(3)->get());

            // кэшируем категории
//            if(cache()->has('categories_sidebar')){
//                $categories = cache()->get('categories_sidebar');
//            } else {
//                $categories = Category::query()->withCount('posts')->get();
//                cache()->put('categories_sidebar',$categories,30);
//            }
            // берём категории и количество постов привязанных к ним
            $view->with('categories', Category::query()->withCount('posts')->get());
        });



        // второй способ
//        View::composer('layouts.sidebar', function (\Illuminate\View\View $view) {
//            // popular_posts будет доступна только в layouts.sidebar
//            $view->with('popular_posts',Post::query()->orderBy('views','desc')->limit(3)->get());
//        });


    }
}
