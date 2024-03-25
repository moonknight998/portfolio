@if ($contact_title)
    @if ($contact_title->status == 1)
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>{{$contact_title->section_name}}</h2>
                <p>{{$contact_title->title}}</p>
            </header>
            <div class="row gy-4">
                <div class="col-lg-6">
                    <div class="row gy-4">
                        @foreach ($contact_items_active as $contact_item_local)
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="{{$contact_item_local->icon}}"></i>
                                <h3>{{$contact_item_local->title}}</h3>
                                <p>{{$contact_item_local->first_line}}</p>
                                <p>{{$contact_item_local->second_line}}</p>
                            </div>
                        </div>                    
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6">
                    <form action="{{route('contact.store')}}" novalidate method="POST" id="message-form" class="message-form">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-md-4">
                                <input type="text" id="name" class="form-control" name="name" placeholder="@lang('admin/common.your_name_required')" required>
                            </div>
                            <div class="col-md-4">
                                <input type="email" id="email" class="form-control" name="email" placeholder="@lang('admin/common.your_email')">
                            </div>
                            <div class="col-md-4">
                                <input type="tel" id="phone_number" class="form-control" name="phone_number" placeholder="@lang('admin/common.phone_number')">
                            </div>
                            <div class="col-md-12">
                                <input type="text" id="message_title" class="form-control" name="message_title" placeholder="@lang('admin/common.title_required')" required>
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control" id="message" name="message" rows="6" placeholder="@lang('admin/common.message_required')" required></textarea>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit">@lang('admin/common.send_message')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="toast-container position-fixed top-0 end-0 p-3">
                @if (session('status') === 'sent')
                <div id="toast-message-success" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <i class="bi bi-check2" style="color: green; font-size: 20px; padding-right: 10px"></i>
                        <strong class="me-auto">{{__('admin/common.success')}}</strong>
                        <small>@lang('admin/common.just_now')</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        @lang('admin/common.message_sent')
                    </div>
                </div>                     
                @endif
                <div id="toast-message-fail" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <i class="bi bi-x" style="color: red; font-size: 20px; padding-right: 10px"></i>
                        <strong class="me-auto">{{__('admin/common.failed')}}</strong>
                        <small>@lang('admin/common.just_now')</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        @lang('admin/common.fields_required')
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
@else
<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <h2>@lang('admin/common.section_name_preview')</h2>
            <p>@lang('admin/common.title_preview')</p>
        </header>
        <div class="row gy-4">
            <div class="col-lg-6">
                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="info-box">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Địa chỉ</h3>
                            <p>A108 Adam Street</p>
                            <p>New York, NY 535022</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <form class="php-email-form">
                    <div class="row gy-4">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="name" placeholder="@lang('admin/common.your_name_required')" required>
                        </div>
                        <div class="col-md-4">
                            <input type="email" class="form-control" name="email" placeholder="@lang('admin/common.your_email')" required>
                        </div>
                        <div class="col-md-4">
                            <input type="tel" class="form-control" name="phone_number" placeholder="@lang('admin/common.phone_number')" required>
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="title_message" placeholder="@lang('admin/common.title_required')" required>
                        </div>
                        <div class="col-md-12">
                            <textarea class="form-control" name="message" rows="6" placeholder="@lang('admin/common.message_required')" required></textarea>
                        </div>
                        <div class="col-md-12 text-center">
                            <button disabled type="submit">@lang('admin/common.send_message')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endif
