@php 
    $siteSettings = App\Models\Setting::find(1);
    $pagesNew = App\Models\Page::where('status', '1')->get();
@endphp


<footer class="footer">
        <div class="container">
            <div class="row section gy-5 gy-xl-0">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="about-company wow fadeInLeft" data-wow-duration="0.8s" style="visibility: visible; animation-duration: 0.8s; animation-name: fadeInLeft;">
                        <div class="footer__logo mb-4">
                            <a href="/">
                                 @if (session()->get('lang') == 'ru')
                             <img src="{{ asset('frontend/logo_ru.png') }}" class="logo" alt="logo" width="160">
                            @elseif(session()->get('lang') == 'en')
                             <img src="{{ asset('frontend/logo_en.png') }}" class="logo" alt="logo" width="160">
                            @else
                             <img src="{{ asset('frontend/logo_tj.png') }}" class="logo" alt="logo" width="160">

                             @endif
                            </a>
                        </div>
                        <p>
                           @if (session()->get('lang') == 'ru')
                            Финансовая грамотность - все знания важны, но финансовые знания важнее!                          
                        @elseif(session()->get('lang') == 'en')
                           Financial literacy - all knowledge is important, but financial knowledge is most important!
                        @else
                          Саводнокии молиявӣ - ҳама донишҳо муҳимманд, вале дониши молиявӣ муҳимтар!
                          
                        @endif
                        </p>
                        <div class="social mt_32">
                            <a href="{{ $siteSettings->facebook }}" class="btn_theme social_box" target="_blank"><i class="bi bi-facebook"></i><span></span></a>
                            <a href="{{ $siteSettings->telegram }}" class="btn_theme social_box" target="_blank"><i class="bi bi-telegram"></i><span></span></a>
                            <a href="{{ $siteSettings->instagram }}" class="btn_theme social_box" target="_blank"><i class="bi bi-instagram"></i><span style="top: 41.6562px; left: 3.5px;"></span></a>
                            <a href="{{ $siteSettings->youtube }}" class="btn_theme social_box" target="_blank"><i class="bi bi-youtube"></i></a>
                          
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="footer__contact ms-sm-4 ms-xl-0 wow fadeInUp" data-wow-duration="0.8s" style="visibility: visible; animation-duration: 0.8s; animation-name: fadeInUp;">
                        <h4 class="footer__title mb-4">
                            @if (session()->get('lang') == 'ru')
                               Контакты
                            @elseif(session()->get('lang') == 'en')
                               Contact
                            @else
                                Тамос
                            @endif

                        </h4>
                        <div class="footer__content">
                            <a href="tel:+1-234-567-891"> <span class="btn_theme social_box"> <i class="bi bi-telephone-plus"></i> </span> {{ $siteSettings->phone }} <span></span> </a> 
                            <a href="mailto:info@example.com"> <span class="btn_theme social_box"> <i class="bi bi-envelope-open"></i> </span> {{ $siteSettings->email }} <span></span> </a> 
                            <a href="#"> <span class="btn_theme social_box"> <i class="bi bi-geo-alt"></i> </span> 
                                @if (session()->get('lang') == 'ru')
                            {{ $siteSettings->street_ru }} &nbsp;
                        @elseif(session()->get('lang') == 'en')
                            {{ $siteSettings->street_en }} &nbsp;
                        @else
                            {{ $siteSettings->street_tj }} &nbsp;
                        @endif
                             <span></span> </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="newsletter wow fadeInDown" data-wow-duration="0.8s" style="visibility: visible; animation-duration: 0.8s; animation-name: fadeInDown;">
                        <h4 class="footer__title mb-4">
                                @if (session()->get('lang') == 'ru')
                                    Рассылка
                                @elseif(session()->get('lang') == 'en')
                                    Newsletter
                                @else
                                    Обуна шудан
                                @endif
                        </h4>
                        <p class="mb_32">
                               @if (session()->get('lang') == 'ru')
                                    Повышайте уровень своей финансовой грамотности вместе с Национальным банком Таджикистана!
                                @elseif(session()->get('lang') == 'en')
                                   Improve your financial literacy together with the National Bank of Tajikistan!
                                @else
                                  Сатҳи саводнокии молиявии худро якҷо бо Бонки миллии Тоҷикистон боз ҳам баландтар бардоред!
                                @endif
                       

                    </p>                  
                        <form action="{{ route('subscribe') }}" method="post" class="form_subscribe_ajax newsletter__content-form">
                             @csrf
                         <!--Grid row-->
                        <div class="row d-flex justify-content-center mt-3">                  
                

                            <!--Grid column-->
                            <div class="input-group">   
                                <input type="email" name="email" class="form-control " required  />                                 
                                <button type="submit" class="emailSubscribe btn_theme btn_theme_active" name="emailSubscribe" id="emailSubscribe"><i class="bi bi-cursor"></i> <span></span></button>                             
                                <span id="subscribeMsg"></span>
                                <span class="text-danger error-text email_error"></span>
                            </div>
                           
                        </div>
                        <!--Grid row-->
                        </form>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="quick-link ms-sm-4 ms-xl-0 wow fadeInRight" data-wow-duration="0.8s" style="visibility: visible; animation-duration: 0.8s; animation-name: fadeInRight;">
                        <h4 class="footer__title mb-4">
                             @if (session()->get('lang') == 'ru')
                               Меню
                            @elseif(session()->get('lang') == 'en')
                                Menu
                            @else
                               Меню
                            @endif
                        </h4>
                        <ul>
                            @foreach ($pagesNew as $page)
                            <li>
                                <a href="/page/{{ $page->url . '/' . $page->id }}">                                
                                    @if (session()->get('lang') == 'ru')
                                        {{ $page->title_ru }}
                                    @elseif(session()->get('lang') == 'en')
                                        {{ $page->title_en }}
                                    @else
                                        {{ $page->title_tj }}
                                    @endif
                                 </a>
                        </li>
                            @endforeach
                          
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="footer__copyright">
                        <p class="copyright text-center">Copyright © <span id="copyYear">2025</span> <a href="#" class="secondary_color">FINGRAM</a></p>
                      
                    </div>
                </div>
            </div>
        </div>
    </footer>