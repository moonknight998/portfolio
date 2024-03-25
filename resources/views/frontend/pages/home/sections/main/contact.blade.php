@if ($contact_title)
    @if ($contact_title->status == 1)
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h2>{{ $contact_title->section_name }}</h2>
                    <p>{{ $contact_title->title }}</p>
                </header>
                <div class="row gy-4">
                    <div class="col-lg-6">
                        <div class="row gy-4">
                            @foreach ($contact_items_active as $contact_item_local)
                                <div class="col-md-6">
                                    <div class="info-box">
                                        <i class="{{ $contact_item_local->icon }}"></i>
                                        <h3>{{ $contact_item_local->title }}</h3>
                                        <p>{{ $contact_item_local->first_line }}</p>
                                        <p>{{ $contact_item_local->second_line }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <form action="{{ route('contact.store') }}" novalidate method="POST" id="message-form"
                            class="message-form">
                            @csrf
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <input type="text" id="name" class="form-control" name="name"
                                        placeholder="@lang('admin/common.your_name_required')" required data-error="#name-error">
                                    <span id="name-error" class="invalid-feedback-2"></span>
                                </div>
                                <div class="col-md-12">
                                    <input type="email" id="email" class="form-control" name="email"
                                        placeholder="@lang('admin/common.your_email')" data-error="#email-error">
                                    <span id="email-error" class="invalid-feedback-2"></span>
                                </div>
                                <div class="col-md-12">
                                    <input type="tel" id="phone_number" class="form-control" name="phone_number"
                                        placeholder="@lang('admin/common.phone_number')" data-error="#phone_number-error">
                                    <span id="phone_number-error" class="invalid-feedback-2"></span>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" id="message_title" class="form-control" name="message_title"
                                        placeholder="@lang('admin/common.title_required')" required data-error="#message_title-error">
                                    <span id="message_title-error" class="invalid-feedback-2"></span>
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control" id="message" name="message" rows="6" placeholder="@lang('admin/common.message_required')"
                                    required data-error="#message-error"></textarea>
                                    <span id="message-error" class="invalid-feedback-2"></span>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button class="send-message" type="submit">@lang('admin/common.send_message')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="toast-container position-fixed top-0 end-0 p-3">
                    <div id="toast-message-success" class="toast" role="alert" aria-live="assertive"
                            aria-atomic="true">
                            <div class="toast-header">
                                <i class="bi bi-check2" style="color: green; font-size: 20px; padding-right: 10px"></i>
                                <strong class="me-auto">{{ __('admin/common.success') }}</strong>
                                <small>@lang('admin/common.just_now')</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast"
                                    aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                @lang('admin/common.message_sent')
                            </div>
                        </div>
                    <div id="toast-message-fail" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <i class="bi bi-x" style="color: red; font-size: 20px; padding-right: 10px"></i>
                            <strong class="me-auto">{{ __('admin/common.failed') }}</strong>
                            <small>@lang('admin/common.just_now')</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"
                                aria-label="Close"></button>
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
                    <form action="{{ route('contact.store') }}" novalidate method="POST" id="message-form"
                        class="message-form">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-md-12">
                                <input type="text" id="name" class="form-control" name="name"
                                    placeholder="@lang('admin/common.your_name_required')" required>
                            </div>
                            <div class="col-md-12">
                                <input type="email" id="email" class="form-control" name="email"
                                    placeholder="@lang('admin/common.your_email')">
                            </div>
                            <div class="col-md-12">
                                <input type="tel" id="phone_number" class="form-control" name="phone_number"
                                    placeholder="@lang('admin/common.phone_number')">
                            </div>
                            <div class="col-md-12">
                                <input type="text" id="message_title" class="form-control" name="message_title"
                                    placeholder="@lang('admin/common.title_required')" required>
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control" id="message" name="message" rows="6" placeholder="@lang('admin/common.message_required')"
                                    required></textarea>
                            </div>
                            <div class="col-md-12 text-center">
                                <button class="send-message" type="submit">@lang('admin/common.send_message')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="toast-container position-fixed top-0 end-0 p-3">
                @if (session('status') === 'sent')
                    <div id="toast-message-success" class="toast" role="alert" aria-live="assertive"
                        aria-atomic="true">
                        <div class="toast-header">
                            <i class="bi bi-check2" style="color: green; font-size: 20px; padding-right: 10px"></i>
                            <strong class="me-auto">{{ __('admin/common.success') }}</strong>
                            <small>@lang('admin/common.just_now')</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            @lang('admin/common.message_sent')
                        </div>
                    </div>
                @endif
                <div id="toast-message-fail" class="toast" role="alert" aria-live="assertive"
                    aria-atomic="true">
                    <div class="toast-header">
                        <i class="bi bi-x" style="color: red; font-size: 20px; padding-right: 10px"></i>
                        <strong class="me-auto">{{ __('admin/common.failed') }}</strong>
                        <small>@lang('admin/common.just_now')</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        @lang('admin/common.fields_required')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

@push('scripts')
    <script>
        $(document).ready(function () {
            $('body').on('submit', '#message-form', function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                let form = $(this);

                $.validator.addMethod("phoneNumber", function (value, element) {
                    return this.optional(element) || value.length > 9 && value.match(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}/);
                }, "@lang('admin/common.phone_number_not_valid')");

                form.validate(
                {
                    rules: {
                        name: {
                            required: true,
                        },
                        email: {
                            email: true,
                        },
                        phone_number: {
                            phoneNumber: true,
                            minlength: 9,
                        },
                        message_title: {
                            required: true,
                        },
                        message: {
                            required: true,
                        }
                    },
                    messages: {
                        name: {
                            required: "@lang('admin/common.your_name_is_required')",
                        },
                        email: {
                            email: "@lang('admin/common.your_email_not_valid')",
                        },
                        phone_number: {
                            phoneNumber: "@lang('admin/common.phone_number_not_valid')",
                            minlength: "@lang('admin/common.phone_number_at_least', ['min' => 9])",
                        },
                        message_title: {
                            required: "@lang('admin/common.title_is_required')",
                        },
                        message: {
                            required: "@lang('admin/common.message_is_required')",
                        }
                    },
                    success: function (error) {
                        error.remove();
                    }
                });

                if (!form.valid()) {
                    return $('#toast-message-fail').toast('show');
                }

                $.ajax({
                    type: "POST",
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function(data, status, xhr)
                    {
                        if(status == 'success')
                        {
                            form[0].reset();
                            $('#toast-message-success').toast('show');
                        }
                        else if (status == 'error')
                        {
                            $('#toast-message-fail').toast('show');
                        }
                    }
                })
            });
        })
    </script>
@endpush
