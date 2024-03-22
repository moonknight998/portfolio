<div class="toast-container position-fixed top-0 end-0 p-3">
    @if (session('status') === 'created')
    <div id="toast-comment-success" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bi bi-check2" style="color: green; font-size: 20px; padding-right: 10px"></i>
            <strong class="me-auto">{{__('admin/common.success')}}</strong>
            <small>@lang('admin/common.just_now')</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            @lang('admin/common.comment_successfully')
        </div>
    </div>                     
    @endif
    <div id="toast-comment-fail" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
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
    <div id="toast-search-fail" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bi bi-x" style="color: red; font-size: 20px; padding-right: 10px"></i>
            <strong class="me-auto">{{__('admin/common.failed')}}</strong>
            <small>@lang('admin/common.just_now')</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            @lang('admin/common.search_missing')
        </div>
    </div>
</div>