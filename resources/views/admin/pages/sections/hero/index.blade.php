@extends('admin.layouts.layout')

@section('content')

<!--Breadcrumb-->
<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.components')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.home')}}</a></li>
            <li class="breadcrumb-item active"><a>{{__('admin/sidebar.hero-section')}}</a></li>
          </ol>
        </nav>
      </div>
</header>
<!--End Breadcrumb-->

<!--Main Part-->
<div class="body flex-grow-1 px-3">
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-lg-12">
                <div class="card-group d-block d-md-flex row">
                    <div class="card col-md-7 p-2 mb-4">
                        <div class="card-body">
                            <h1>{{__('admin-profile.edit_profile')}}</h1>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-lg-12">
                <div class="card-group d-block d-md-flex row">
                    {{-- <h3 class="mb-4">{{__('admin/hero/hero-index.edit')}}</h3> --}}
                    <div class="card col-md-7 p-2 mb-4">
                        <div class="card-header"><h2>{{__('admin/hero/hero-index.edit')}}</h2></div>
                        <form method="POST" action="{{route('admin.hero.update', 1)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body" style="padding-top: 10pt">
                                @if (session('status') === 'updated')
                                    {{-- <div class="valid-feedback mb-4" style="display: inline; color: rgb(25, 192, 25); font-size: 18px;">
                                        {{__('admin/hero/hero-index.updated')}}
                                    </div> --}}
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{__('admin/hero/hero-index.updated')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">{{__('admin/hero/hero-index.slogan')}}</label>
                                    <input class="form-control" id="slogan" name="slogan" type="text" placeholder="{{__('admin/hero/hero-index.slogan-placeholder')}}" value="{{old('slogan')}}">
                                    @if ($errors->has('slogan'))
                                        <div class="row mb-0">
                                            <div class="invalid-feedback" style="display: inline;">{{$errors->first('slogan')}}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">{{__('admin/hero/hero-index.short-description')}}</label>
                                    <textarea class="form-control" rows="5" id="short_description" name="short_description" type="text" placeholder="{{__('admin/hero/hero-index.shor-description-placeholder')}}">{{old('short_description')}}</textarea>
                                    @if ($errors->has('short_description'))
                                        <div class="row mb-0">
                                            <div class="invalid-feedback" style="display: inline;">{{$errors->first('short_description')}}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">{{__('admin/hero/hero-index.button-text')}}</label>
                                    <input class="form-control" id="button_text" name="button_text" type="text" readonly="" value="{{__('admin/hero/hero-index.find-out-now')}}">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">{{__('admin/hero/hero-index.button-link')}}</label>
                                    <input class="form-control" id="button_link" name="button_link" type="url" readonly="" value="#about">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">{{__('admin/hero/hero-index.image')}}</label>
                                    <input class="form-control" id="image" name="image" type="file">
                                    @if ($errors->has('image'))
                                        <div class="row mb-0">
                                            <div class="invalid-feedback" style="display: inline;">{{$errors->first('image')}}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <button class="btn btn-primary mb-3" type="submit">{{__('admin/hero/hero-index.update')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="card col-md-5 text-white bg-primary py-5">
                        <div class="card-body text-center">
                        <div>
                            <h2>Sign up</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <button class="btn btn-lg btn-outline-light mt-3" type="button">Register Now!</button>
                        </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Main Part-->

@endsection
