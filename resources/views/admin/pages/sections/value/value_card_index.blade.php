@extends('admin.layouts.layout')

@section('content')

<!--Breadcrumb-->
<header class="header header-sticky mb-4" style="z-index: 0">
    <div class="container-fluid m-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.components')}}</a></li>
            <li class="breadcrumb-item"><a>{{__('admin/sidebar.home')}}</a></li>
            <li class="breadcrumb-item active"><a>{{__('admin/value/value-index.value_section')}}</a></li>
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
                            <h2>{{__('admin/value/value-index.all_value_card')}}</h2>
                            <a href="{{route('admin.value_card.create')}}" class="btn btn-success">{{__('admin/common.create_new')}} <i class="fas fa-plus"></i></a>
                        </div>
                        <div class="card-body">
                            {{-- <div class="table-responsive">
                                {{$dataTable->table()}}
                            </div> --}}
                            {{$dataTable->table()}}
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
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
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
                url: "{{route('admin.value_card.change-status')}}",
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
