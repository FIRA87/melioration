@extends('frontend.master')

@section('title')
    @trans('contact')

@endsection

@php
    $siteSettings = App\Models\Setting::find(1);

@endphp
@section('content')


<!-- Banner Start -->
<section class="banner">
    <div class="container ">
        <div class="row gy-4 gy-sm-0 align-items-center">
            <div class="col-12 col-sm-6">
                <div class="banner__content">
                    <h1 class="banner__title display-4 wow fadeInLeft" data-wow-duration="0.8s"> @trans('contact') </h1> 
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb wow fadeInRight" data-wow-duration="0.8s">
                            <li class="breadcrumb-item">
                                @if (session()->get('lang') == 'ru')
                                    <a href="{{ url('/') }}" class="nav-item nav-link">Главная</a>
                                @elseif(session()->get('lang') == 'en')
                                    <a href="{{ url('/') }}" class="nav-item nav-link">Main</a>
                                @else
                                    <a href="{{ url('/') }}" class="nav-item nav-link">Асосӣ</a>
                                @endif
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"> @trans('contact')    </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="banner__thumb text-end">
                    <img src="frontend/assets/images/contact_banner.png" alt="image">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner End -->
   
<!-- contact start -->
<section class="sign-up contact section">
    <div class="container">
        <div class="row gy-5 gy-xl-0 justify-content-center justify-content-lg-between">
            <div class="col-12 col-lg-7 col-xxl-8">
                 <form action="{{ route('contact_form_submit') }}" method="POST" class="form_subscribe_ajax sign-up__form wow fadeInDown">
                        @csrf
                       
                        <h3 class="contact__title wow fadeInDown" data-wow-duration="0.8s">@trans('contact_us')     </h3>

                        <div class="sign-up__form-part">
                            <div class="input-group">
                            <div class="input-single">
                                 <label class="label" for="name">
                                     @if(session()->get('lang') == 'ru')
                                         Имя
                                      @elseif(session()->get('lang') == 'en')
                                         Name
                                      @else
                                         Ном
                                      @endif
                                 </label>
                                <input type="text" class="form-control " placeholder="Your Name" name="name" required>
                                <span class="text-danger error-text name_error"></span>
                            </div>
                            <div class="input-single">
                                <label class="label" for="email">Email</label>
                                <input type="email" class="form-control " placeholder="Your Email" name="email" required>
                                <span class="text-danger error-text email_error"></span>
                            </div>
                            <div class="col-12">
                                <label class="label" for="message">
                                     @if(session()->get('lang') == 'ru')
                                         Сообщение
                                      @elseif(session()->get('lang') == 'en')
                                         Message
                                      @else
                                         Ном
                                      @endif
                                </label>
                                <textarea class="form-control" rows="4" placeholder="Message" name="message" required></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn_theme btn_theme_active mt_40" type="submit">
                                    @if(session()->get('lang') == 'ru')
                                         Отправить
                                      @elseif(session()->get('lang') == 'en')
                                         Send Message
                                      @else
                                         Ирсол
                                      @endif
                                </button>
                            </div>
                        </div>
                         </div>
                    </form>
            </div>
            <div class="col-12 col-lg-5 col-xxl-4">
                <div class="more-help wow fadeInUp" data-wow-duration="0.8s">
                    <h4 class="contact__title wow fadeInUp" data-wow-duration="0.8s">
                        @if(session()->get('lang') == 'ru')
                           Нужна дополнительная помощь?
                        @elseif(session()->get('lang') == 'en')
                          Need more help?
                        @else
                           Кӯмаки бештар лозим аст?
                        @endif


                    </h4>
                    <div class="more-help__content">
                        <div class="card card--small">
                            <div class="card--small-icon">
                                <i class="bi bi-telephone"></i> 
                            </div>
                            <div class="card--small-content">
                                <h5 class="card--small-title">
                                      @if(session()->get('lang') == 'ru')
                                           Позвонить сейчас
                                        @elseif(session()->get('lang') == 'en')
                                           Call Now
                                        @else
                                           Занг занед
                                        @endif

                               </h5>
                                <div class="gap-1 flex-column">
                                    <a href="tel:+{{ $siteSettings->phone }}" class="card--small-call">{{ $siteSettings->phone }}</a>
                            
                                </div>
                            </div>
                        </div>
                        <div class="card card--small">
                            <div class="card--small-icon">
                                <i class="bi bi-envelope-open"></i> 
                            </div>
                            <div class="card--small-content">
                                <h5 class="card--small-title">Email </h5>
                                <div class="gap-1 flex-column">
                                    <a href="mailto:{{ $siteSettings->email }}" class="card--small-call">{{ $siteSettings->email }}</a>
                          
                                </div>
                            </div>
                        </div>
                        <div class="card card--small">
                            <div class="card--small-icon">
                                <i class="bi bi-geo-alt"></i> 
                            </div>
                            <div class="card--small-content">
                                <h5 class="card--small-title">
                                    @if(session()->get('lang') == 'ru')
                                           Местонахождение
                                        @elseif(session()->get('lang') == 'en')
                                           Location
                                        @else
                                           Макон
                                        @endif
                                </h5>
                                <div class="gap-1 flex-column">
                                    <p>
                                         @if (session()->get('lang') == 'ru')
                                            {{ $siteSettings->street_ru }} &nbsp;
                                        @elseif(session()->get('lang') == 'en')
                                            {{ $siteSettings->street_en }} &nbsp;
                                        @else
                                            {{ $siteSettings->street_tj }} &nbsp;
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact end -->   


    <!-- Blog End -->
    <script>
        (function($){
            $(".form_contact_ajax").on('submit', function(e){
                e.preventDefault();
                $('#loader').show();
                let form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                        $(form).find('span.error-text').text('');
                    },
                    success:function(data)
                    {
                        $('#loader').hide();
                        if(data.code == 0)
                        {
                            $.each(data.error_message, function(prefix, val) {
                                $(form).find('span.'+prefix+'_error').text(val[0]);
                            });
                        }
                        else if(data.code == 1)
                        {
                            $(form)[0].reset();
                            iziToast.success({
                                title: '',
                                position: 'topRight',
                                message: data.success_message,
                            });
                        }

                    }
                });
            });
        })(jQuery);
    </script>
    <div id="loader"></div>
@endsection
