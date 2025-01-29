@extends('admin.layouts.default')

@section('title','New Category')

@section('content')
    <main class="app-main"> <!--begin::App Content Header-->
        <div class="app-content-header"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">New Post</h3>
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
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title ">New Post</h3>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="list-unstyled">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="post" action="{{ route('posts.store') }}" class="ajax-form">
                                @csrf
                                <div class="row"> <!--begin::Col-->

                                    <div class="col-md-12">


                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="title" class="form-label required">Post
                                                    name</label>
                                                <input type="text" name="title" class="form-control" id="title"
                                                       value="{{ old('title') }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="meta_desc" class="form-label">Meta
                                                    description</label>
                                                <input type="text" name="meta_desc" class="form-control" id="meta_desc"
                                                       value="{{ old('meta_desc') }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="excerpt" class="form-label required">Excerpt</label>
                                                <input type="text" name="excerpt" class="form-control" id="excerpt"
                                                       value="{{ old('excerpt') }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="content"
                                                       class="form-label required">Content</label>
                                                <textarea class="form-control ckeditor" name="content" id="content"
                                                          cols="10"
                                                          rows="5">{{ old('content') }}</textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="category_id"
                                                       class="form-label required">Category</label>
                                                <select name="category_id" id="category_id" class="form-select">
                                                    @foreach($categories as $category_id => $category_title)
                                                        <option value="{{$category_id}}" @selected(old('category_id') == $category_id)>{{$category_title}}</option>
                                                    @endforeach


                                                </select>
                                            </div>


                                            <div class="mb-3">
                                                <label for="tags"
                                                       class="form-label ">Tags</label>
                                                <select name="tags[]" id="tags" class="form-select select2" multiple>
                                                    @foreach($tags as $tag_id => $tag_title)
                                                        <option value="{{$tag_id}}" {{old('tags') && in_array($tag_id,old('tags')) ? 'selected' : ''}}>{{$tag_title}}</option>
                                                    @endforeach


                                                </select>
                                            </div>




                                            <div class="mb-3">
                                                <input type="hidden" id="thumb" name="thumb" value="">
                                                <button type="button" class="btn btn-outline-primary popup_selector"
                                                        data-inputid="thumb">Post Image
                                                </button>
                                                <div class="post-thumb mt-3"></div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <button type="submit" class="btn btn-warning">Save</button>
                                        </div>

                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!--end::Row--> <!--begin::Row-->
            </div> <!--end::Container-->
        </div> <!--end::App Content-->
    </main>
@endsection

