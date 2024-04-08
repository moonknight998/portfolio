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
                    <li class="breadcrumb-item active"><a>{{ __('admin/value/value-index.value_section') }}</a></li>
                </ol>
            </nav>
        </div>
        <!--End Breadcumb-->
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
                                <h2>{{ __('admin/value/value-index.all_value_card') }}</h2>
                                <a href="{{ route('admin.value_card.create') }}"
                                    class="btn btn-success">{{ __('admin/common.create_new') }} <i
                                        class="fas fa-plus"></i></a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead class="fw-semibold text-nowrap">
                                            <tr class="align-middle">
                                                <th class="text-center">Id</th>
                                                <th class="text-center">@lang('admin/common.title')</th>
                                                <th class="text-center">@lang('admin/team/team.description')</th>
                                                <th class="text-center">@lang('admin/common.status')</th>
                                                <th class="text-center">@lang('admin/common.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($value_cards_paginate as $value_card_local)
                                                <tr class="align-middle">
                                                    <td class="text-center" style="width: 70px">{{ $value_card_local->id }}</td>
                                                    <td class="text-center">{{ $value_card_local->title }}</td>
                                                    <td class="text-center">{{ $value_card_local->description }}</td>
                                                    <td style="width: 100px">
                                                        <div class="form-check form-switch"
                                                            style="display: flex; justify-content: center">
                                                            <input class="form-check-input change-status"
                                                                {{ $value_card_local->status == 1 ? 'checked' : '' }}
                                                                data-id="{{ $value_card_local->id }}" type="checkbox"
                                                                role="switch" id="flexSwitchCheckChecked">
                                                        </div>
                                                    </td>
                                                    <td style="width: 200px">
                                                        <div class="d-flex justify-content-center align-items-center gap-1">
                                                            <a href="{{ route('admin.value_card.edit', $value_card_local->id) }}"
                                                                class="btn btn-success"><span class="d-none d-md-inline">@lang('admin/common.edit') </span><i class="fas fa-pen">
                                                            </i></a>
                                                            <a href="{{ route('admin.value_card.destroy', $value_card_local->id) }}"
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
                                    {{ $value_cards_paginate->links('vendor.pagination.bootstrap-5') }}
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
                    url: "{{ route('admin.value_card.change-status') }}",
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
