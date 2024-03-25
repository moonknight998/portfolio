@extends('admin.layouts.layout')

@section('content')

<?php
    $contact_items_paginate = GetPaginateByCollection($contact_items, 10);
?>

<!--Breadcrumb-->
<header class="header header-sticky mb-4" style="z-index: 0">
    <div class="container-fluid m-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.components')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.home')}}</a></li>
            <li class="breadcrumb-item"><a>@lang('admin/sidebar.contact_section')</a></li>
            <li class="breadcrumb-item active"><a>@lang('admin/sidebar.contact_items')</a></li>
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
                            <h2>@lang('admin/contact/contact.all_items')</h2>
                            <a href="{{route('admin.contact_item.create')}}" class="btn btn-success">{{__('admin/common.create_new')}}<i class="fas fa-plus"></i></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead class="table-light fw-semibold">
                                      <tr class="align-middle">
                                        <th class="text-center">Id</th>
                                        <th class="text-center">@lang('admin/contact/contact.title')</th>
                                        <th class="text-center">@lang('admin/contact/contact.first_line')</th>
                                        <th class="text-center">@lang('admin/contact/contact.second_line')</th>
                                        <th class="text-center">@lang('admin/common.icon')</th>
                                        <th class="text-center">@lang('admin/common.status')</th>
                                        <th class="text-center">@lang('admin/common.action')</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contact_items_paginate as $contact_item_local)
                                        <tr class="align-middle">
                                            <td class="text-center" style="width: 70px">{{$contact_item_local->id}}</td>
                                            <td class="text-center">{{$contact_item_local->title}}</td>
                                            <td class="text-center">{{$contact_item_local->first_line}}</td>
                                            <td class="text-center">{{$contact_item_local->second_line}}</td>
                                            <td class="text-center"><i class="{{$contact_item_local->icon}}"></i></td>
                                            <td style="width: 100px">
                                                <div class="form-check form-switch" style="display: flex; justify-content: center">
                                                    <input class="form-check-input change-status" {{$contact_item_local->status == 1 ? 'checked' : ''}} data-id="{{$contact_item_local->id}}" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                                </div>
                                            </td>
                                            <td style="width: 200px">
                                                <div style="display: flex; justify-content: center; gap: 5px">
                                                    <a href="{{route('admin.contact_item.edit', $contact_item_local->id)}}" class="btn btn-success edit-btn">{{__('admin/common.edit')}} <i class="fas fa-pen"></i></a>
                                                    <a href="{{route('admin.contact_item.destroy', $contact_item_local->id)}}" class="btn btn-danger delete-btn">{{__('admin/common.delete')}} <i class="fa-solid fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                {{$contact_items_paginate->links('vendor.pagination.bootstrap-5')}}
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
                url: "{{route('admin.contact_item.change-status')}}",
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
