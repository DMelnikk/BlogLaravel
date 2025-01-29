@extends('admin.layouts.default')

@section('title','New Category')

@section('content')
    <main class="app-main"> <!--begin::App Content Header-->
        <div class="app-content-header"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Edit Category</h3>
                    </div>
                                        <div class="col-sm-6">
                                            <ol class="breadcrumb float-sm-end">
                                                <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Home</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">
                                                    Categories
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
                                  <h3 class="card-title">Edit Category: <strong>{{$category->title}}</strong></h3>
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


                              <form class="form-horizontal" method="post" action="{{route('categories.update',['category'=>$category->id])}}">
                                  @csrf
                                  @method('PUT')
                                  <div class="card-body">

                                      <div class="form-group row mb-3">
                                          <label for="title" class="col-sm-2 col-form-label required">Category name</label>
                                          <div class="col-sm-10">
                                              <input value="{{$category->title}}" type="text" name="title" class="form-control" id="title"
                                                required     placeholder="Category">
                                          </div>
                                      </div>

                                      <div class="form-group row mb-3">
                                          <label for="meta_desc" class="col-sm-2 col-form-label">Meta description</label>
                                          <div class="col-sm-10">
                                              <input value="{{$category->meta_desc}}" type="text" name="meta_desc" class="form-control" id="meta_desc"
                                                 required     placeholder="Category">
                                          </div>
                                      </div>


                                  </div>

                                  <div class="card-footer">
                                      <button type="submit" class="btn btn-info">Save</button>
                                  </div>
                                  <!-- /.card-footer -->
                              </form>
                          </div>
                    </div>
                </div> <!--end::Row--> <!--begin::Row-->
            </div> <!--end::Container-->
        </div> <!--end::App Content-->
    </main>
@endsection

