@extends('admin.layouts.layout')

@section('content')

<!--Breadcrumb-->
<header class="header header-sticky mb-4" style="z-index: 0">
    <div class="container-fluid m-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.components')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.home')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.blog_section')}}</a></li>
            <li class="breadcrumb-item active"><a>{{__('admin/blog/blog.blog_posts')}}</a></li>
          </ol>
        </nav>
      </div>
</header>
<!--End Breadcrumb-->

<!--Main Part-->
<div class="body flex-grow-1 px-1">
    <div class="container-fluid" style="height: 100%">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-group d-block d-md-flex row">
                    <div class="card col-md-7 p-2 mb-4">
                        <div class="card-header">
                            <h2>{{__('admin/blog/blog.all_blog_post')}}</h2>
                            <a href="{{route('blog.blog_post.create')}}" class="btn btn-success">{{__('admin/common.create_new')}}<i class="fas fa-plus"></i></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table border mb-0">
                                    <thead class="table-light fw-semibold">
                                      <tr class="align-middle">
                                        <th class="text-center">Id</th>
                                        <th>@lang('admin/faq/faq.title')</th>
                                        <th class="text-center">@lang('admin/common.thumbnail')</th>
                                        <th class="text-center">@lang('admin/sidebar.category')</th>
                                        <th class="text-center">@lang('admin/common.status')</th>
                                        <th class="text-center">@lang('admin/common.action')</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr class="align-middle">
                                        @foreach ($blog_posts as $blog_post)
                                            <td class="text-center" style="width: 70px">{{$blog_post->id}}</td>
                                            <td>{{Str::limit($blog_post->post_title, 10)}}</td>
                                            <td style="width: 150px">
                                                <div class="container" style="display: flex; justify-content: center; width: 80px">
                                                    <img class="img-thumbnail" src="{{$blog_post->thumbnail}}" style="object-fit: contain"></img>
                                                </div>
                                            </td>
                                            <td class="text-center">{{$blog_post->category->category_name}}</td>
                                            <td style="width: 100px">
                                                <div class="form-check form-switch" style="display: flex; justify-content: center">
                                                    <input class="form-check-input change-status" {{$blog_post->status == 1 ? 'checked' : ''}} data-id="{{$blog_post->id}}" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                                </div>
                                            </td>
                                            <td style="width: 200px">
                                                <div style="display: flex; justify-content: center; gap: 5px">
                                                    <a href="{{route('blog.blog_post.edit', $blog_post->id)}}" class="btn btn-success">{{__('admin/common.edit')}} <i class="fas fa-pen"></i></a>
                                                    <a href="{{route('blog.blog_post.destroy', $blog_post->id)}}" class="btn btn-danger">{{__('admin/common.delete')}} <i class="fa-solid fa-trash"></i></a>
                                                </div>
                                            </td>
                                        @endforeach
                                      </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Main Part-->

@endsection

@push('scripts')
    {{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }} --}}
    <script>
        $(document).ready(function(){
            $('body').on('click', '.change-status', function(){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                url: "{{route('blog.blog_post.change-status')}}",
                type: 'PUT',
                data:{
                    "status": isChecked,
                    "id": id
                },
                success: function(data)
                {
                    console.log(data);
                },
                error: function(xhr, status, error)
                {
                    console.log(error);
                }
                })
            })
        });
    </script>
@endpush
