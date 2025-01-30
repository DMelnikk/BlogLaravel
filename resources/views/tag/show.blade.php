@extends('layouts.tag')


@section('title',"Markedia :: Tag: {$tag->title}")
@section('meta_desc',"$tag->meta_desc")
@section('content')
    <div class="page-wrapper">
        <div class="blog-custom-build">
            @forelse($posts as $post)
                <div class="blog-box wow fadeIn">
                    <div class="post-media">
                        <a href="{{route('posts.single',['slug'=>$post->slug])}}">

                            <img src="{{$post->getPostThumb()}}" alt="{{$post->title}}" class="img-fluid">

                            <div class="hovereffect">
                                <span></span>
                            </div>
                            <!-- end hover -->
                        </a>
                    </div>
                    <!-- end media -->
                    <div class="blog-meta big-meta text-center">
                        <div class="post-sharing">
                            <ul class="list-inline">
                                <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                                <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                                <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div><!-- end post-sharing -->
                        <h4><a href="{{route('posts.single',['slug'=>$post->slug])}}" title="{{$post->title}}">You can learn how to make money with your blog and videos</a></h4>
                        <p>{{$post->excerpt}}</p>
                        <small><a href="{{route('categories.single',['slug'=>$post->category->slug])}}" title="">{{$post->category->title}}</a></small>
                        <small><span>{{$post->getPostDate()}}</span></small>
                        <small><span><i class="fa fa-eye"></i>{{$post->views}}</span></small>
                    </div><!-- end meta -->
                </div><!-- end blog-box -->

                <hr class="invis">
            @empty
                <p>No posts</p>
            @endforelse
        </div>
    </div>

    <hr class="invis">

    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation">
                {{$posts->links('vendor.pagination.bootstrap-5-front')}}
            </nav>
        </div><!-- end col -->
    </div><!-- end row -->
@endsection
