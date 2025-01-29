@extends('admin.layouts.default')

@section('title','Posts')

@section('content')
    <main class="app-main"> <!--begin::App Content Header-->
        <div class="app-content-header"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Posts</h3>
                    </div>
                                        <div class="col-sm-6">
                                            <ol class="breadcrumb float-sm-end">
                                                <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Home</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">
                                                    Posts
                                                </li>
                                            </ol>
                                        </div>
                </div> <!--end::Row-->
            </div> <!--end::Container-->
        </div> <!--end::App Content Header--> <!--begin::App Content-->
        <div class="app-content"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row"> <!--begin::Col-->
                    <div class="col-md-12">
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        <div class="card">
                            <div class="card-header">
                                <a href="{{route('posts.create')}}" class="btn btn-primary">Add Post</a>
                                <a href="{{route('admin.posts.basket')}}" class="btn btn-danger">Basket <span class="badge text-bg-light rounded-pill">{{$basket_cnt}}</span></a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">ID</th>
                                        <th>Thumb</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Tags</th>
                                        <th style="width: 150px">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td>{{$post->id}}</td>
                                            <td><img src="/{{$post->thumb ?: env('NO_IMAGE')}}" alt="" height="50"></td>
                                            <td>{{$post->title}}</td>
                                            <td>{{$post->category->title}}</td>
{{--                                            <td>{{$post->tags->pluck('title')->join(',')}}</td>--}}
                                            <td>{{$post->tags->implode('title',',')}}</td>
                                            <td class="d-flex gap-2">
                                                <a href="{{route('posts.edit',['post'=>$post->id])}}" style="height: 40px" class="btn btn-info">Edit</a>
                                                <form action="{{route('posts.destroy',['post'=>$post->id])}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                <button  onclick="return confirm('Confirm action')" class="btn btn-warning">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{$posts->links()}}
{{--                                <ul class="pagination pagination-sm m-0 float-right">--}}
{{--                                    <li class="page-item"><a class="page-link" href="#">«</a></li>--}}
{{--                                    <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--                                    <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                                    <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                                    <li class="page-item"><a class="page-link" href="#">»</a></li>--}}
{{--                                </ul>--}}
                            </div>
                        </div>
                    </div>
                </div> <!--end::Row--> <!--begin::Row-->
            </div> <!--end::Container-->
        </div> <!--end::App Content-->
    </main>
@endsection

