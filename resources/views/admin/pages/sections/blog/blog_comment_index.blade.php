@extends('admin.layouts.layout')

@section('content')
    <?php
    $blog_comments_per_page = GetPaginateByCollection($blog_comments, 10);
    ?>

    <!--Header-->
    <header class="header header-sticky p-0 mb-4">
        @include('admin.layouts.user_option')
        <!-- Breadcrumb-->
        <div class="container-fluid px-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-0">
                    <li class="breadcrumb-item"><a>{{ __('admin/sidebar.components') }}</a></li>
                    <li class="breadcrumb-item"><a>{{ __('admin/sidebar.blog_section') }}</a></li>
                    <li class="breadcrumb-item"><a>{{ __('admin/blog/blog.blog_post') }}</a></li>
                    <li class="breadcrumb-item active"><a>{{ __('admin/blog/blog.comments') }}</a></li>
                </ol>
            </nav>
        </div>
    </header>
    <!--End Header-->

    <!--Main Part-->
    <div class="body flex-grow-1 px-1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-group d-block d-md-flex row">
                        <div class="card col-md-7 p-2 mb-4">
                            <div class="card-header">
                                <h2>{{ __('admin/blog/blog.blog_comments_from') . '[' . Str::limit($blog_post->post_title, 50) . ']' }}
                                </h2>
                                {{-- <a href="{{route('blog.blog_post.create')}}" class="btn btn-success">{{__('admin/common.create_new')}}<i class="fas fa-plus"></i></a> --}}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead class="fw-semibold text-nowrap">
                                            <tr class="align-middle">
                                                <th class="text-center">Id</th>
                                                <th class="text-center">@lang('admin/common.name')</th>
                                                <th class="text-center">@lang('login.email')</th>
                                                <th class="text-center">@lang('admin/common.phone_number')</th>
                                                <th class="text-center">@lang('admin/blog/blog.comments')</th>
                                                <th class="text-center">@lang('admin/common.status')</th>
                                                <th class="text-center">@lang('admin/common.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($blog_comments_per_page as $blog_comment_local)
                                                <tr class="align-middle">
                                                    <td class="text-center" style="width: 70px">
                                                        {{ $blog_comment_local->id }}</td>
                                                    <td class="text-center">{{ $blog_comment_local->name }}</td>
                                                    <td>{{ $blog_comment_local->email }}</td>
                                                    <td class="text-center">{{ $blog_comment_local->phone_number }}</td>
                                                    <td class="text-center">{{ $blog_comment_local->comment }}</td>
                                                    <td style="width: 100px">
                                                        <div class="form-check form-switch"
                                                            style="display: flex; justify-content: center">
                                                            <input class="form-check-input change-status"
                                                                {{ $blog_comment_local->status == 1 ? 'checked' : '' }}
                                                                data-id="{{ $blog_comment_local->id }}" type="checkbox"
                                                                role="switch" id="flexSwitchCheckChecked">
                                                        </div>
                                                    </td>
                                                    <td style="width: 200px">
                                                        <div style="display: flex; justify-content: center; gap: 5px">
                                                            <a href="{{ route('blog.blog_comment.destroy', $blog_comment_local->id) }}"
                                                                class="btn btn-danger delete-btn">{{ __('admin/common.delete') }}
                                                                <i class="fa-solid fa-trash"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $blog_comments_per_page->links('vendor.pagination.bootstrap-5') }}
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
        $(document).ready(function() {
            $('body').on('click', '.change-status', function() {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('blog.blog_comment.change-status') }}",
                    type: 'PUT',
                    data: {
                        "status": isChecked,
                        "id": id
                    },
                    success: function(data) {

                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        });
    </script>
@endpush
