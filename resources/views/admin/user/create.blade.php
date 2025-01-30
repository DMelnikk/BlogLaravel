@extends('admin.layouts.default')

@section('title','New User')

@section('content')
    <main class="app-main"> <!--begin::App Content Header-->
        <div class="app-content-header"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">New User</h3>
                    </div>
                                        <div class="col-sm-6">
                                            <ol class="breadcrumb float-sm-end">
                                                <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Home</a></li>
                                                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">
                                                    New User
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
                                  <h3 class="card-title">New User</h3>
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


                              <form class="form-horizontal ajax-form" method="post" action="{{route('users.store')}}">
                                  @csrf
                                  <div class="card-body">

                                      <div class="form-group row mb-3">
                                          <label  for="name" class="col-sm-2 col-form-label required">Name</label>
                                          <div class="col-sm-10">
                                              <input type="text" value="{{old('name')}}"  name="name" class="form-control" id="name"
                                                     placeholder="Name">
                                          </div>
                                      </div>

                                      <div class="form-group row mb-3">
                                          <label  for="email" class="col-sm-2 col-form-label required">Email</label>
                                          <div class="col-sm-10">
                                              <input type="email"  name="email" class="form-control" value="{{old('email')}}" id="email"
                                                     placeholder="Email">
                                          </div>
                                      </div>

                                      <div class="form-group row mb-3">
                                          <label  for="password" class="col-sm-2 col-form-label required">Password</label>
                                          <div class="col-sm-10">
                                              <input type="password"  name="password" class="form-control" id="password"
                                                     placeholder="Password">
                                          </div>
                                      </div>

                                      <div class="form-group row mb-3">
                                          <label  for="password_confirmation" class="col-sm-2 col-form-label required">Password Confirmation</label>
                                          <div class="col-sm-10">
                                              <input type="password"  name="password_confirmation" class="form-control" id="password_confirmation"
                                                     placeholder="Confirm Password">
                                          </div>
                                      </div>


                                      <div class="form-check">
                                          <input class="form-check-input" type="checkbox" value="1" id="is_admin" name="is_admin" @checked(old('is_admin'))>
                                          <label class="form-check-label" for="is_admin">
                                              Is Admin
                                          </label>
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

