@extends('frontend.master')
@section('content')

@php
    $categories = App\Models\Category::orderBy('position', 'ASC')->get();
    $testimonials = App\Models\Testimonial::where('status', 'Yes')->limit(4)->get();
    $galleries = App\Models\Gallery::limit(3)->limit(1)->get();
    $videos = App\Models\Video::where('status', 'Yes')->orderBy('id', 'desc')->limit(4)->get();
    $links = App\Models\Link::where('status', '1')->limit(6)->get();
@endphp
<!-- Hero Section Start -->


<section class="hero hero-version3 overflow-visible hero--secondary">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-12">
            

                <div class="section__content text-center">

                         <span class="section__content-sub-title headingFour mb-lg-4 mb-3 wow fadeInDown text-uppercase" data-wow-duration="0.8s">
                        
                        @if (session()->get('lang') == 'ru')
                         <img src="{{ asset('frontend/nbt_ru.png') }}" alt="vector" style="width: 300px;"> 
                        @elseif(session()->get('lang') == 'en')
                           <img src="{{ asset('frontend/nbt_en.png') }}" alt="vector" style=" width: 300px;"> 
                        @else
                           <img src="{{ asset('frontend/nbt_tj.png') }}" alt="vector" style=" width: 300px;"> 
                        @endif               

                </span>
               
                         <h5 class="section__content-title m-auto display-3 mb-lg-3 mb-3 wow fadeInUp" data-wow-duration="1s">

                        @if (session()->get('lang') == 'ru')
                            Образовательный веб-сайт <br>по финансовой грамотности 
                        @elseif(session()->get('lang') == 'en')
                             Financial Literacy Education Website
                        @else
                              Сомонаи таълимӣ оид <br>ба саводнокии молиявӣ
                        @endif

                </h5>
                     </div>
            </div>
        </div>
        <div class="loan-tabbing-wrap d-flex flex-wrap">
          @foreach ($categories as $key => $category)
            <div class="loan-tab-items">
                <img src="{{ $category->icon}}" alt="img" class="loan-thumb" style="height: 100px;">
                <h4 class="n700 mt-2" id="category_h4">  
                    <a href="{{ url('news/category/' . $category->id . '/' . $category->category_slug) }}">
                         @if (session()->get('lang') == 'ru')
                            {{ $category->title_ru }}
                        @elseif(session()->get('lang') == 'en')
                            {{ $category->title_en }}
                        @else
                            {{ $category->title_tj }}
                        @endif
                   </a>
             </h4>
                <a href="{{ url('news/category/' . $category->id . '/' . $category->category_slug) }}" class="mortgage-icon">
                    <i class="bi bi-arrow-up-right"></i>
                </a>
            </div>
           @endforeach
       
        </div>
    </div>
    <!-- Element -->
     <img src="{{ asset('frontend/assets/images/home3-shapel.png') }}" alt="img" class="home3-shapel">
     <img src="{{ asset('frontend/assets/images/home3-shaper.png') }}" alt="img" class="home3-shaper">
     <img src="{{ asset('frontend/assets/images/home3-element.png') }}" alt="img" class="home3-element">
</section>
<!--Hero Section End -->










<!-- Ammout Comaprison start -->
 <section class="ammount-comparison">
     <div class="loan-reviews">
         <div class="container">
         
             <div class="row justify-content-center">
                 <div class="col-lg-12">
                     <div class="d-flex flex-column gap-4">
                        @foreach ($latestNews as $news)
                        <div class="loan-reviews_card position-relative overflow-hidden card wow fadeInUp" data-wow-duration="0.8s">
                            <div class="loan-reviews__part-one">
                                <div class="reviews__thumb">
                                     <img src="{{ $news->image}}" alt="image" width="300">
                                </div>
                              
                            </div>
                            <div class="price-content">
                                <div class="form-price d-flex align-items-end">
                                     <h5>
                                    

                                     @if (session()->get('lang') == 'ru')
                                        {{ $news->category->title_ru }}
                                    @elseif(session()->get('lang') == 'en')
                                        {{ $news->category->title_en }}
                                    @else
                                        {{ $news->category->title_tj }}
                                    @endif 
                                     </h5> 
                                </div>
                              
                                  <div class="load-price-box">
                                       
                                        <h5>
                                   @if (session()->get('lang') == 'ru')
                                        {{ $news->title_ru }}
                                    @elseif(session()->get('lang') == 'en')
                                        {{ $news->title_en }}
                                    @else
                                        {{ $news->title_tj }}
                                    @endif
                                        </h5>
                                    </div>
                            </div>
                        


                            <div class="loan-reviews__part-three">
                                <div class="btn-group">                                  
                                    <a href="{{ url('news/details/' . $news->id . '/' . $news->slug) }}" class="btn_theme btn_theme_active">
                                          @if (session()->get('lang') == 'ru')
                                            Подробнее
                                        @elseif(session()->get('lang') == 'en')
                                            Readmore
                                        @else
                                            Бештар
                                        @endif
                                        <i class="bi bi-arrow-up-right"></i><span></span></a>
                           
                                </div>
                            </div>
                            <span class="interest-badge text-uppercase">
                                 @php
                                            $my_time = strtotime($news->post_date);
                                            $update_date = date('d.m.Y', $my_time);
                                        @endphp
                                        {{ $update_date }}
                            </span>
                        </div>
                        @endforeach
                     </div>
                 </div>
                 <div class="col-12">
                     <div class="section__cta">
                         <a href="{{ route('frontend.news') }}" class="btn_theme see_all wow fadeInDown" data-wow-duration="0.8s">
                        @if(session()->get('lang') == 'ru') 
                            Все новости
                            @elseif(session()->get('lang') == 'en') 
                            All news
                            @else 
                            Ҳамаи хабарҳо
                         @endif
                            <i class="bi bi-arrow-up-right"></i><span></span></a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
<!-- Ammout Comaprison End -->

<!-- Choose Us start -->
<section class="choose-u">
    <div class="container">
       <div class="row justify-content-center">
            <div class="col-12 col-lg-6 col-xxl-6 mt-5">
                <div class="section__header" style="margin-bottom: 0;">
                 

                   <div class="section__content ms-lg-4 ms-xl-0">
                    <span class="section__content-sub-title headingFour wow fadeInDown" data-wow-duration="0.8s"><img src="{{ asset('frontend/assets/images/title_vector.png') }}" alt="vector">
                        @if (session()->get('lang') == 'ru')
                          <a href="{{ url('frontend/videos') }}" class="btn_theme btn_theme_active wow fadeInDown" data-wow-duration="0.8s">  Видео <i class="bi bi-arrow-up-right"></i><span></span></a>
                        @elseif(session()->get('lang') == 'en')
                          <a href="{{ url('frontend/videos') }}" class="btn_theme btn_theme_active wow fadeInDown" data-wow-duration="0.8s">  Video <i class="bi bi-arrow-up-right"></i><span></span></a>
                        @else
                          <a href="{{ url('frontend/videos') }}" class="btn_theme btn_theme_active wow fadeInDown" data-wow-duration="0.8s">  Видео <i class="bi bi-arrow-up-right"></i><span></span></a>
                        @endif
                    </span>     
                    
                </div>

              </div>
              </div>
              </div>      

        <div class="row gy-5 gy-lg-0 justify-content-between align-items-center section" style="padding-top: 30px;">
             @foreach ($videos as $key => $item)
            <div class="col-12 col-sm-6 col-xxl-3">
                    <div class="card card--custom">
                        <div class="card__icon">
                            <a href="http://www.youtube.com/watch?v={{ $item->video_url }}"class="video-button" target="_blank">
                        <i class="fas fa-play"></i>
                           <img src="{{ asset($item->caption) }}" alt="images">
                               </a>
                                                             
                        </div>
                        <div class="card__content">
                            <h4 class="card__title">
                            @if (session()->get('lang') == 'ru')
                                {{ $item->title_ru }}
                            @elseif(session()->get('lang') == 'en')
                                {{ $item->title_en }}
                            @else
                                {{ $item->title_tj }}
                            @endif
                            </h4>
                       
                        </div>
                    </div>
                </div>
             @endforeach
        </div>


    </div>
</section>
<!--  Choose Us end -->



<!-- About Us start -->
<section class="about-sectionv3 section">
    <div class="container">
        <div class="row justify-content-center justify-content-lg-between align-items-center gy-5 gy-lg-0">
            <div class="col-12 col-lg-6 col-xxl-5 order-1 order-lg-0">
                <div class="about-thumbv3 me-lg-5 me-xxl-0 wow fadeInDown" data-wow-duration="0.8s">
                    <img src="{{ asset('frontend/assets/images/elearning.png') }}" alt="images">
                </div>
            </div>
          
            <div class="col-12 col-lg-6 col-xxl-6">
                    @foreach ($galleries as $gallery)
                <div class="section__content ms-lg-4 ms-xl-0">
                    <span class="section__content-sub-title headingFour wow fadeInDown" data-wow-duration="0.8s"><img src="{{ asset('frontend/assets/images/title_vector.png') }}" alt="vector">
                        @if (session()->get('lang') == 'ru')
                          <a href="{{ url('frontend/galleries') }}" class="btn_theme btn_theme_active wow fadeInDown" data-wow-duration="0.8s">  Картинки <i class="bi bi-arrow-up-right"></i><span></span></a>
                        @elseif(session()->get('lang') == 'en')
                          <a href="{{ url('frontend/galleries') }}" class="btn_theme btn_theme_active wow fadeInDown" data-wow-duration="0.8s">  Images <i class="bi bi-arrow-up-right"></i><span></span></a>
                        @else
                          <a href="{{ url('frontend/galleries') }}" class="btn_theme btn_theme_active wow fadeInDown" data-wow-duration="0.8s">  Нигорхонаи аксҳо  <i class="bi bi-arrow-up-right"></i><span></span></a>
                        @endif
                    </span>     
                    
                </div>


                       @endforeach
            </div>
            
        </div>
    </div>
</section>
<!-- About Us end -->

<!-- Client Testimonials start -->
<section class="testimonials-section3 section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 col-xxl-6">
                <div class="section__header">
                    <span class="section__header-sub-title headingFour wow fadeInDown" data-wow-duration="0.8s"><img src="{{ asset('frontend/assets/images/title_vector.png') }}" alt="vector" >
                     @if (session()->get('lang') == 'ru')
                            Советы от экспертов
                        @elseif(session()->get('lang') == 'en')
                            Expert tips
                        @else
                            Маслиҳатҳои коршиносон
                        @endif
                    </span>
                    <h2 class="section__header-title wow fadeInUp" data-wow-duration="0.8s">
                         @if (session()->get('lang') == 'ru')
                            Формируйте правильные финансовые привычки
                        @elseif(session()->get('lang') == 'en')
                            Build the right financial habits
                        @else
                            Одатҳои дурусти молиявиро ташаккул диҳед
                        @endif
                    </h2>
                 
                </div>
            </div>
        </div>
        <div class="row g-3">            
            <div class="col-xxl-7 col-lg-7 position-relative">
                <div class="testimonials-secondary_slider3 wow fadeInDown" data-wow-duration="0.8s">
                
                    @foreach ($testimonials as $item)
                    <div class="card p-0">
                        <div class="testimonials__author-review mb-4">
                         
                            <p class="text-start">
                                 @if (session()->get('lang') == 'ru')
                                    {!! $item->text_ru !!}
                                @elseif(session()->get('lang') == 'en')
                                    {!!  $item->text_en  !!}
                                @else
                                    {!!  $item->text_tj  !!}
                                @endif
                            </p>
                        </div>
                        <div class="testimonials__author d-flex align-items-center gap-xxl-4 gap-2">
                            <div class="author__thumg">
                                <img src="{{ $item->image }}" alt="img" width="100">
                            </div>
                            <div class="author__content">
                                <h5 class="author__title">
                                      @if (session()->get('lang') == 'ru')
                                    {{ $item->work_ru }}
                                @elseif(session()->get('lang') == 'en')
                                    {{ $item->work_en }}
                                @else
                                    {{ $item->work_tj }}
                                @endif
                                </h5>
                                <span class="author__desi">
                                        @if (session()->get('lang') == 'ru')
                                    {{ $item->title_ru }}
                                @elseif(session()->get('lang') == 'en')
                                    {{ $item->title_en }}
                                @else
                                    {{ $item->title_tj }}
                                @endif
                                </span>
                            </div>
                        </div>
                    </div>
                      @endforeach
                </div>
                <div class="slider-navigation d-flex mt-0 justify-content-end">
                    <button class="prev-testimonials pagination-button">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    
                    <button class="next-testimonials pagination-button">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>
            <div class="col-lg-1 d-xxl-block d-none"></div>
            <div class="col-xxl-4 col-xl-4 col-lg-5">
                <div class="testimonial-thumv3 position-relative">
                    <img src="{{ asset('frontend/assets/images/online-course.png') }}" alt="img">
         
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Client Testimonials end -->

<!-- faq start -->

<section class="section faq-section" id="faqa">
    <div class="container">
    <div class="row justify-content-center">
                <div class="col-12 col-lg-7 col-xxl-6">
                    <div class="section__header">
                        <span class="section__header-sub-title headingFour wow fadeInDown" data-wow-duration="0.8s" style="visibility: visible; animation-duration: 0.8s; animation-name: fadeInDown;"><img src="frontend/assets/images/title_vector.png" alt="vector">

                         @if (session()->get('lang') == 'ru')
                            Часто задаваемые вопросы
                        @elseif(session()->get('lang') == 'en')
                            Frequently Asked Questions
                        @else
                            Саволҳои маъмулӣ
                        @endif


                       </span>
                        <h2 class="section__header-title wow fadeInUp" data-wow-duration="0.8s" style="visibility: visible; animation-duration: 0.8s; animation-name: fadeInUp;">FAQ</h2>
                  
                    </div>
                </div>
            </div> 

        <div class="row gy-4">
            @foreach($faqs->chunk(ceil($faqs->count() / 2)) as $faqChunk)
                <div class="col-lg-6">
                    <div class="accordion" id="faq-accordion-{{ $loop->index }}">
                        @foreach($faqChunk as $item)
                            <div class="accordion-item accordion_bg">
                                <h5 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-{{ $loop->parent->index }}-{{ $loop->index }}"
                                        aria-expanded="false" aria-controls="faq-{{ $loop->parent->index }}-{{ $loop->index }}">
                                      @if (session()->get('lang') == 'ru')
                                        {{ $item->question_ru }}
                                    @elseif(session()->get('lang') == 'en')
                                        {{ $item->question_en }}
                                    @else
                                        {{ $item->question_tj }}
                                    @endif
                                    </button>
                                </h5>
                                <div id="faq-{{ $loop->parent->index }}-{{ $loop->index }}"
                                    class="accordion-collapse collapse"
                                    data-bs-parent="#faq-accordion-{{ $loop->parent->index }}">
                                    <div class="accordion-body">
                                        <p class="mb-0">
                                             @if (session()->get('lang') == 'ru')
                                            {!! $item->answer_ru !!}
                                        @elseif(session()->get('lang') == 'en')
                                            {!! $item->answer_en !!}
                                        @else
                                            {!! $item->answer_tj !!}
                                        @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- faq end -->



<!-- download-app start -->
<section class="download-app3">
    <div class="container">
        <div class="download-wrap p-5">
            <div class="row justify-content-center justify-content-lg-between align-items-center gy-5 gy-lg-0">
                @foreach ($links as $link)
                <div class="col-sm-6 col-xxl-2">                   
                    <div class="card card--custom">
                         <a href="{{ $link->url }}">
                        <img src="{{ asset($link->img) }}" alt="{{ $link->title_ru }}" >
                    </a>                            
                    </div>                   
                </div>
                   @endforeach
                      
                    </div>
                </div>
            </div>
            <!-- Element -->
        </div>
    </div>
</section>
<!-- download-app end -->

@endsection
