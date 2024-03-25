<div class="toast-container position-fixed top-0 end-0 p-3">
    @if (session('status') === 'created')
    <div id="toast-created" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bi bi-check2" style="color: green; font-size: 20px; padding-right: 10px"></i>
            <strong class="me-auto">{{__('admin/common.success')}}</strong>
            <small>@lang('admin/common.just_now')</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            @lang('admin/common.created_successfully')
        </div>
    </div>                     
    @endif
    @if (session('status') === 'updated')
    <div id="toast-updated" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bi bi-check2" style="color: green; font-size: 20px; padding-right: 10px"></i>
            <strong class="me-auto">{{__('admin/common.success')}}</strong>
            <small>@lang('admin/common.just_now')</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            @lang('admin/common.updated_successfully')
        </div>
    </div>                     
    @endif
    <div id="toast-failed" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bi bi-x" style="color: red; font-size: 20px; padding-right: 10px"></i>
            <strong class="me-auto">{{__('admin/common.failed')}}</strong>
            <small>@lang('admin/common.just_now')</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            @lang('admin/common.comment_missing')
        </div>
    </div>
</div>