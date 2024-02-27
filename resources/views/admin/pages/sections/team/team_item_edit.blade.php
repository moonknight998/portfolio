@extends('admin.layouts.layout')

@section('content')
<!--Breadcrumb-->
<header class="header header-sticky mb-4" style="z-index: 0">
    <div class="container-fluid m-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.components')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.home')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.team_section')}}</a></li>
            <li class="breadcrumb-item active"><a>{{__('admin/team/team.create_item')}}</a></li>
          </ol>
        </nav>
      </div>
</header>
<!--End Breadcrumb-->

<!--Main Part-->
<div class="body flex-grow-1 px-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-group d-block d-md-flex row">
                    <div class="card col-md-7 p-2 mb-4">
                        <div class="card-header">
                            <h2>{{__('admin/team/team.create_item')}}</h2>
                        </div>
                        <form method="POST" action="{{route('admin.team_item.update', $team_item->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="example">
                                    <ul class="nav nav-tabs" role="tablist">
                                      <li class="nav-item" role="presentation"><a class="nav-link active"
                                        data-coreui-toggle="tab" role="tab" aria-selected="true" onclick="openTab(event, 'content_tab', 'preview_tab')">
                                          <svg class="icon me-2">
                                            <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-media-play')}}"></use>
                                          </svg>{{__('admin/common.content')}}</a>
                                        </li>
                                    <li class="nav-item" role="presentation"><a class="nav-link"
                                        data-coreui-toggle="tab" role="tab" aria-selected="false" onclick="openTab(event, 'preview_tab', 'content_tab')">
                                            <svg class="icon me-2">
                                            <use xlink:href="{{asset('backend/assets/vendors/@coreui/icons/svg/free.svg#cil-code')}}"></use>
                                            </svg>{{__('admin/common.preview')}}</a>
                                        </li>
                                    </ul>
                                    <!--Edit Tab-->
                                    <div class="tab-content rounded-bottom" id="content_tab">
                                      <div class="tab-pane p-3 active preview" role="tabpanel" >
                                        @if (session('status') === 'updated')
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{__('admin/team/team.item_updated')}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        @endif
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/team/team.name')}}</label>
                                            <input class="form-control" id="name" name="name" type="text" placeholder="{{__('admin/team/team.name_placeholder')}}"
                                            onchange="loadDocument(event, 'preview_name')" value="{{$team_item->name}}"></input>
                                            @if ($errors->has('name'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('name')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/team/team.work_title')}}</label>
                                            <input class="form-control" id="work_title" name="work_title" type="text" placeholder="{{__('admin/team/team.work_title_placeholder')}}"
                                            onchange="loadDocument(event, 'preview_work_title')" value="{{$team_item->work_title}}"></input>
                                            @if ($errors->has('work_title'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('work_title')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/team/team.description')}}</label>
                                            <textarea class="form-control" rows="5" id="description" name="description" type="text"
                                            onchange="loadDocument(event, 'preview_description')"
                                            onkeypress="detectEnterline(event, 'description'); loadDocument(event, 'preview_description')"
                                            placeholder="{{__('admin/team/team.description_placeholder')}}">{{$team_item->description}}</textarea>
                                            @if ($errors->has('description'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('description')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.image')}}</label>
                                            <input class="form-control" id="image" name="image" type="file" onchange="loadFile(event, 'preview_image')">
                                            @if ($errors->has('image'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('image')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/team/team.facebook_url')}}</label>
                                            <input class="form-control" id="facebook_url" name="facebook_url" type="url" placeholder="{{__('admin/team/team.facebook_url_placeholder')}}"
                                            onchange="loadDocument(event, 'preview_facebook_url')" value="{{$team_item->facebook_url}}"></input>
                                            @if ($errors->has('facebook_url'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('facebook_url')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/team/team.instagram_url')}}</label>
                                            <input class="form-control" id="instagram_url" name="instagram_url" type="url" placeholder="{{__('admin/team/team.instagram_url_placeholder')}}"
                                            onchange="loadDocument(event, 'preview_instagram_url')" value="{{$team_item->instagram_url}}"></input>
                                            @if ($errors->has('name'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('instagram_url')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/team/team.telegram_url')}}</label>
                                            <input class="form-control" id="telegram_url" name="telegram_url" type="url" placeholder="{{__('admin/team/team.telegram_url_placeholder')}}"
                                            onchange="loadDocument(event, 'preview_telegram_url')" value="{{$team_item->telegram_url}}"></input>
                                            @if ($errors->has('name'))
                                                <div class="row mb-0">
                                                    <div class="invalid-feedback" style="display: inline;">{{$errors->first('telegram_url')}}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{__('admin/common.status')}}</label>
                                            <select class="form-select" id="status" name="status">
                                                <option {{$team_item->status == 1 ? 'selected' : ''}} value="1">{{__('admin/common.display')}}</option>
                                                <option {{$team_item->status == 0 ? 'selected' : ''}} value="0">{{__('admin/common.hide')}}</option>
                                            </select>
                                        </div>
                                      </div>
                                    </div>
                                    <!--End Edit Tab-->

                                    <!--Preview Tab-->
                                    <div class="tab-content rounded-bottom" id="preview_tab" style="display: none">
                                        <div class="tab-pane active preview" role="tabpanel">
                                            @if (MobileDetect()->isMobile())
                                            <div class="alert alert-warning fade show mt-4" role="alert">
                                                {{__('admin/common.about_mobile_warning')}}
                                            </div>
                                            @endif
                                            <section id="team" class="team">
                                                <div class="container" data-aos="fade-up">
                                                    <header class="section-header">
                                                        <h2 id="preview_section_name">{{ShowTextData($team_title, "section_name", __('admin/common.section_name_preview'))}}</h2>
                                                        <p id="preview_title">{{ShowTextData($team_title, "title", __('admin/common.title_preview'))}}</p>
                                                    </header>
                                                    <div class="row gy-4" style="justify-content: center">
                                                        @if (count($team_items) > 0)
                                                            @foreach ($team_items as $team_item_local)
                                                                @if ($team_item_local->id == $team_item->id)
                                                                <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                                                                    <div class="member">
                                                                        <div class="member-img">
                                                                            <img id="preview_image" src="{{$team_item_local->image}}" class="img-fluid" alt="" style="object-fit:cover; width:261px; height:261px;">
                                                                            <div class="social">
                                                                                <a id="preview_facebook_url" href="{{$team_item_local->facebook_url}}"><i class="bi bi-facebook"></i></a>
                                                                                {{-- <a href=""><i class="bi bi-twitter"></i></a> --}}
                                                                                <a id="preview_instagram_url" href="{{$team_item_local->instagram_url}}"><i class="bi bi-instagram"></i></a>
                                                                                <a id="preview_telegram_url" href="{{$team_item_local->telegram_url}}"><i class="bi bi-telegram"></i></a>
                                                                                {{-- <a href=""><i class="bi bi-linkedin"></i></a> --}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="member-info">
                                                                            <h4 id="preview_name">{{$team_item_local->name}}</h4>
                                                                            <span id="preview_work_title">{{$team_item_local->work_title}}</span>
                                                                            <p id="preview_description">{{$team_item_local->description}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @else
                                                                <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                                                                    <div class="member">
                                                                        <div class="member-img">
                                                                            <img src="{{$team_item_local->image === "" ? asset('frontend/assets/img/team/team-2.jpg') : $team_item_local->image}}" class="img-fluid" alt="" style="object-fit:cover; width:261px; height:261px;">
                                                                            <div class="social">
                                                                                <a href="{{$team_item_local->facebook_url}}"><i class="bi bi-facebook"></i></a>
                                                                                {{-- <a href=""><i class="bi bi-twitter"></i></a> --}}
                                                                                <a href="{{$team_item_local->instagram_url}}"><i class="bi bi-instagram"></i></a>
                                                                                <a href="{{$team_item_local->telegram_url}}"><i class="bi bi-telegram"></i></a>
                                                                                {{-- <a href=""><i class="bi bi-linkedin"></i></a> --}}
                                                                            </div>
                                                                        </div>
                                                                            <div class="member-info">
                                                                            <h4>{{$team_item_local->name}}</h4>
                                                                            <span>{{$team_item_local->work_title}}</span>
                                                                            <p>{{$team_item_local->description}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                    <!--End Preview Tab-->
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <button class="btn btn-primary mb-3" type="submit">{{__('admin/common.create_new')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Main Part-->

@endsection
