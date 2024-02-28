@if ($team_title)
    @if ($team_title->status)
    <section id="team" class="team">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>{{ShowTextData($team_title, "section_name", __('admin/common.section_name_preview'))}}</h2>
                <p>{{ShowTextData($team_title, "title", __('admin/common.title_preview'))}}</p>
            </header>
            <div class="row gy-4" style="justify-content: center">
                @if (count($team_items_active) > 0)
                    @foreach ($team_items_active as $team_item_local)
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                            <div class="member">
                                <div class="member-img">
                                    <img src="{{$team_item_local->image === "" ? asset('frontend/assets/img/team/team-2.jpg') : $team_item_local->image}}" class="img-fluid mem-img" alt="">
                                    <div class="social">
                                        <a href="{{$team_item_local->facebook_url}}" target="_blank"><i class="bi bi-facebook"></i></a>
                                        {{-- <a href=""><i class="bi bi-twitter"></i></a> --}}
                                        <a href="{{$team_item_local->instagram_url}}" target="_blank"><i class="bi bi-instagram"></i></a>
                                        <a href="{{$team_item_local->telegram_url}}" target="_blank"><i class="bi bi-telegram"></i></a>
                                        {{-- <a href=""><i class="bi bi-linkedin"></i></a> --}}
                                    </div>
                                </div>
                                    <div class="member-info">
                                    <h4>{{$team_item_local->name}}</h4>
                                    <span>{{$team_item_local->work_title}}</span>
                                    <p>{{$team_item_local->description}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{asset('frontend/assets/img/team/team-1.jpg')}}" class="img-fluid mem-img" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    {{-- <a href=""><i class="bi bi-twitter"></i></a> --}}
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-telegram"></i></a>
                                    {{-- <a href=""><i class="bi bi-linkedin"></i></a> --}}
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>{{__('admin/common.name_preview')}}</h4>
                                <span>{{__('admin/team/team.work_title_preview')}}</span>
                                <p>{{__('admin/common.description_preview')}}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    @endif
@else
<section id="team" class="team">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <h2>{{__('admin/common.section_name_preview')}}</h2>
            <p>{{__('admin/common.title_preview')}}/p>
        </header>
        <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
                <div class="member-img">
                    <img src="{{asset('frontend/assets/img/team/team-1.jpg')}}" class="img-fluid mem-img" alt="">
                    <div class="social">
                        <a href=""><i class="bi bi-facebook"></i></a>
                        {{-- <a href=""><i class="bi bi-twitter"></i></a> --}}
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-telegram"></i></a>
                        {{-- <a href=""><i class="bi bi-linkedin"></i></a> --}}
                    </div>
                </div>
                <div class="member-info">
                    <h4>{{__('admin/common.name_preview')}}</h4>
                    <span>{{__('admin/team/team.work_title_preview')}}</span>
                    <p>{{__('admin/common.description_preview')}}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
