@extends('admin.layouts.layout')

@section('content')
    <!--Header-->
    <header class="header header-sticky p-0 mb-4">
        @include('admin.layouts.user_option')
        <!-- Breadcrumb-->
        <div class="container-fluid px-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-0">
                    <li class="breadcrumb-item"><a>{{ __('admin/sidebar.components') }}</a></li>
                    <li class="breadcrumb-item"><a>{{ __('admin/sidebar.home') }}</a></li>
                    <li class="breadcrumb-item"><a>{{ __('admin/sidebar.blog_section') }}</a></li>
                    <li class="breadcrumb-item active"><a>{{ __('admin/blog/blog.categories') }}</a></li>
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
                                <h2>{{ __('admin/blog/blog.all_category') }}</h2>
                                @if (session('status') === 'required')
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ __('admin/blog/blog.category_empty') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <a href="{{ route('blog.blog_category.create') }}"
                                    class="btn btn-success">{{ __('admin/common.create_new') }} <i
                                        class="fas fa-plus"></i></a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead class="fw-semibold text-nowrap">
                                            <tr class="align-middle">
                                                <th class="text-center">Id</th>
                                                <th class="text-center">@lang('admin/blog/blog.category_name')</th>
                                                <th class="text-center">Slug</th>
                                                <th class="text-center">@lang('admin/common.status')</th>
                                                <th class="text-center">@lang('admin/common.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories_paginate as $category_local)
                                                <tr class="align-middle">
                                                    <td class="text-center" style="width: 70px">{{ $category_local->id }}</td>
                                                    <td class="text-center">{{ $category_local->category_name }}</td>
                                                    <td class="text-center">{{ $category_local->slug }}</td>
                                                    <td style="width: 100px">
                                                        <div class="form-check form-switch"
                                                            style="display: flex; justify-content: center">
                                                            <input class="form-check-input change-status"
                                                                {{ $category_local->status == 1 ? 'checked' : '' }}
                                                                data-id="{{ $category_local->id }}" type="checkbox"
                                                                role="switch" id="flexSwitchCheckChecked">
                                                        </div>
                                                    </td>
                                                    <td style="width: 200px">
                                                        <div class="d-flex justify-content-center align-items-center gap-1">
                                                            <a href="{{ route('blog.blog_category.edit', $category_local->id) }}"
                                                                class="btn btn-success"><span class="d-none d-md-inline">@lang('admin/common.edit') </span><i class="fas fa-pen">
                                                            </i></a>
                                                            <a href="{{ route('blog.blog_category.destroy', $category_local->id) }}"
                                                                class="btn btn-danger delete-btn"><span class="d-none d-md-inline">@lang('admin/common.delete') </span><i class="fas fa-trash">
                                                            </i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $categories_paginate->links('vendor.pagination.bootstrap-5') }}
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
                    url: "{{ route('blog.blog_category.change-status') }}",
                    type: 'PUT',
                    data: {
                        "status": isChecked,
                        "id": id
                    },
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        });
    </script>
@endpush
