@extends('frontend.master')

@section('title')
    @if(session()->get('lang') == 'ru')
        Страница
    @elseif(session()->get('lang') == 'en')
        Page
    @else
         Саҳифа
    @endif
@endsection

@php
    $review = App\Models\Review::where('news_id', $news->id)->where('status', '1')->latest()->limit(5)->get();
    $categories = App\Models\Category::orderBy('id', 'ASC')->get();
@endphp


@section('content')
  
<!-- Banner Start -->
<section class="banner">
<div class="container ">
    <div class="row gy-4 gy-sm-0 align-items-center">


        <div class="col-12 col-sm-12">
            <div class="banner__content">
                <h1 class="banner__title display-4 wow fadeInLeft" data-wow-duration="0.8s">
                @if (session()->get('lang') == 'ru')
                    {{ $news->title_ru }}
                @elseif(session()->get('lang') == 'en')
                    {{ $news->title_en }}
                @else
                    {{ $news->title_tj }}
                @endif
                </h1> 
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb wow fadeInRight" data-wow-duration="0.8s">
                        <li class="breadcrumb-item"><a href="/">
                            @if (session()->get('lang') == 'ru')
                            <a href="{{ url('/') }}" class="nav-item nav-link">Главная</a>
                        @elseif(session()->get('lang') == 'en')
                            <a href="{{ url('/') }}" class="nav-item nav-link">Main</a>
                        @else
                            <a href="{{ url('/') }}" class="nav-item nav-link">Асосӣ</a>
                        @endif

                        </a></li>                     
                        <li class="breadcrumb-item active" aria-current="page">
                            @if(session()->get('lang') == 'ru')
                                {{ $breadcat->title_ru }}
                            @elseif(session()->get('lang') == 'en')
                                {{ $breadcat->title_en }}
                            @else
                                {{ $breadcat->title_tj }}
                            @endif
                        </li>

                         <li class="breadcrumb-item active" aria-current="page">
                         @if (session()->get('lang') == 'ru')
                            {{ $news->title_ru }}
                        @elseif(session()->get('lang') == 'en')
                            {{ $news->title_en }}
                        @else
                            {{ $news->title_tj }}
                        @endif
                        </li>


                    </ol>
                </nav>
            </div>
        </div>



       
    </div>
</div>
</section>
<!-- Banner End -->

    <!-- Blog details start -->
    <section class="blog-details section">
        <div class="container ">
            <div class="row gy-4 gy-lg-0">
                <div class="col-12 col-lg-7 col-xl-8">
                    <div class="gap-4 flex-column">
                        <div class="card card--secondary">
                            <div class="card--secondary__thumb wow fadeInUp" data-wow-duration="0.8s"> <img src="{{ asset($news->image) }}" alt="image"></div>
                            <div class="card--secondary__content">
                                <div class="card--secondary__content-part wow fadeInDown" data-wow-duration="0.8s">
                                    <p class="card--secondary__time mb-4">
                                        <span class="gap-6"> <i class="bi bi-person-circle"></i>Fingram</span><i class="bi bi-dot"></i> 
                                        <span class="gap-6"><i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($news->post_date)->format('Y-m-d') }} </span><i class="bi bi-dot"></i><span class="gap-6"><i class="bi bi-chat-text"></i>{{ count($review) }}</span>
                                    </p>                                                  
                                
                                </div>
                                <h4>
                                      @if (session()->get('lang') == 'ru')
                                        {{ $news->title_ru }}
                                    @elseif(session()->get('lang') == 'en')
                                        {{ $news->title_en }}
                                    @else 
                                        {{ $news->title_tj }}
                                    @endif

                                </h4>

                                <p class="card--secondary__text">
                                 @if (session()->get('lang') == 'ru')
                                        {!! html_entity_decode($news->news_details_ru, ENT_QUOTES, 'UTF-8') !!}
                                    @elseif(session()->get('lang') == 'en')
                                        {!! html_entity_decode($news->news_details_en, ENT_QUOTES, 'UTF-8') !!}
                                    @else
                                        {!! html_entity_decode($news->news_details_tj, ENT_QUOTES, 'UTF-8') !!}
                                    @endif
                                                            
                            </div>
                        </div>
                        <div class="card card--secondary part">
                            <div class="comments-area">
                                <div class="space_between">
                                    <h4 class=" wow fadeInDown" data-wow-duration="0.8s">
                                          @if (session()->get('lang') == 'ru')
                                           Комментарии
                                        @elseif(session()->get('lang') == 'en')
                                            All comments
                                        @else
                                            Шарҳ
                                        @endif

                                    </h4>
                                  
                                </div>
                                 @foreach ($review as $item)
                                    @if ($item->status == 0)
                                    @else
                                <div class="author__content author__content--secondary wow fadeInUp" data-wow-duration="0.8s">
                                    <p class="author__submit-time">{{ \Carbon\Carbon::parse($news->post_date)->format('Y-m-d') }} <i class="bi bi-dot"></i> </p>
                                    
                                    <div class="gap-7">
                                        <div class="author__thumbs">
                                            <img src="{{ !empty($item->user->photo) ? url('upload/images/users/' . $item->user->photo) : url('upload/no-image.jpg') }}" alt="image" width="50">
                                        </div>
                                        <div class="author__info">
                                            <h5 class="author__name">{{ $item->user['name'] ?? 'Гость' }}</h5>
                                            <p>{{ $item->comment }}</p>
                                        </div>
                                    </div>
                                    <div class="feedback">                                       
                                        <div class="reply__content">
                                            <div class="gap-7">
                                                <div class="author__thumbs">
                                                    <img src="{{ !empty($item->user->photo) ? url('upload/images/users/' . $item->user->photo) : url('upload/no-image.jpg') }}" alt="Author">
                                                </div>
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                  @endif
                        @endforeach
                              
                            </div>
                           
                        </div>

    @guest
    <div class="card card--secondary part wow fadeInUp" data-wow-duration="0.8s">
        <div class="sign-up contact">
             <form action="{{ route('store.review') }}" method="POST" autocomplete="off" id="frmContactus" class="sign-up__form">
                    @csrf
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                        @elseif(session('error'))
                            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                        @endif
                        <input type="hidden" name="news_id" value="{{ $news->id }}">
                        <h3 class="contact__title">
                         @if (session()->get('lang') == 'ru') 
                            Оставить комментарий 
                         @elseif(session()->get('lang') == 'en') 
                            Write a comments  
                         @else 
                            Шарҳ гузоштан
                         @endif
           
                   </h3>
                    <div class="sign-up__form-part">                     
                        <div class="input-single"> 
                            <label class="label" for="name">
                                 @if (session()->get('lang') == 'ru') 
                                    Имя 
                                 @elseif(session()->get('lang') == 'en') 
                                    Name 
                                 @else 
                                    Ном
                                 @endif

                            </label>
                            <input class="form-control" rows="5" name="user_id" id="name" required> 
                        </div>
                        <div class="input-single">
                            <label class="label" for="email">Email</label>
                            <input type="email" class="form-control" name="email"   required>
                        </div>
                        <div class="input-single mt-2"> 
                   
                            <textarea class="form-control" rows="5"  name="comment" required></textarea> 
                        </div>                    
                 </div>
                  <button class="btn_theme btn_theme_active mt_40" type="submit">
                      @if (session()->get('lang') == 'ru') 
                         Комментировать
                       @elseif(session()->get('lang') == 'en') 
                          Write a comments  
                       @else 
                          Шарҳ додан
                       @endif

                     <i class="bi bi-arrow-up-right"></i><span></span></button>
                </form>
        </div>
    </div>
@else
    <div class="card card--secondary part wow fadeInUp" data-wow-duration="0.8s">
        <div class="sign-up contact">
            <form action="{{ route('store.review') }}" method="POST" class="sign-up__form" autocomplete="off">
                    @csrf
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                    @elseif(session('error'))
                        <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                    @endif
                    <input type="hidden" name="news_id" value="{{ $news->id }}">
                     <h3 class="contact__title">
                           @if (session()->get('lang') == 'ru') 
                              Оставить комментарий 
                           @elseif(session()->get('lang') == 'en') 
                              Write a Comments  
                           @else 
                              Шарҳ гузоштан
                           @endif
                     </h3>
  <div class="sign-up__form-part">
                    <div class="row g-3">
                        <div class="col-12">
                            <textarea class="form-control " rows="5"  name="comment"></textarea>
                        </div>
                        <div class="col-12">
                            <button  type="submit"  class="btn_theme btn_theme_active mt_40">

                                  @if (session()->get('lang') == 'ru') 
                                      Комментировать 
                                   @elseif(session()->get('lang') == 'en') 
                                      Write a comments  
                                   @else 
                                     Шарҳ додан
                                   @endif

                                 <i class="bi bi-arrow-up-right"></i><span></span></button>
                        </div>
                    </div>
                      </div>
                </form>
        </div>
    </div>
@endguest

                    </div>



                </div>

                <div class="col-12 col-lg-5 col-xl-4 ">
                    <div class="sidebar cus_scrollbar wow fadeInDown" data-wow-duration="0.8s">
                        <div class="sidebar__part">
                            <h4 class="sidebar__part-title">
                                  @if (session()->get('lang') == 'ru')
                                   Поиск
                                @elseif(session()->get('lang') == 'en')
                                    Search
                                @else
                                    Ҷустуҷӯ
                                @endif
                            </h4>
                     <form action="{{ route('news.search') }}" method="POST" id="filter_search" class="filter__search">
                                  @csrf
                                <div class="input-group">
                                      @if (session()->get('lang') == 'ru')
                                        <input type="text" class="form-control bg-transparent p-3" placeholder="Поиск" name="search" required>
                                    @elseif(session()->get('lang') == 'en')
                                        <input type="text" class="form-control bg-transparent p-3" placeholder="Search" name="search"  required>
                                    @else
                                        <input type="text" class="form-control bg-transparent p-3" placeholder="Ҷустуҷӯ" name="search" required>
                                    @endif
                       
                                    <button type="submit" class="search_icon"><i class="bi bi-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="sidebar__part">
                            <h4 class="sidebar__part-title">
                                  @if (session()->get('lang') == 'ru')
                                    Категории
                                @elseif(session()->get('lang') == 'en')
                                    Categories
                                @else
                                    Категорияҳо
                                @endif
                            </h4>
                            <ul class="category">
                              @foreach ($categories as $key => $category)
                                <li><a href="{{ url('news/category/' . $category->id . '/' . $category->category_slug) }}">
                                    <span class="caregory__icon">
                                         <img src="/{{ $category->icon}}" alt="img" class="loan-thumb">
                                  </span> 
                                  <span class="caregory__content">
                                         @if (session()->get('lang') == 'ru')
                                            {{ $category->title_ru }}
                                        @elseif(session()->get('lang') == 'en')
                                            {{ $category->title_en }}
                                        @else
                                            {{ $category->title_tj }}
                                        @endif
                                  </span> 
                                </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar__part">
                            <h4 class="sidebar__part-title">
                                @if(session()->get('lang') == 'ru') 
                                   Последние
                                @elseif(session()->get('lang') == 'en') 
                                    Latest
                                @else 
                                    Охирин
                                @endif

                            </h4>
                            <div class="recent-posts">
                                @foreach ($popularNews as $news)
                                <div class="recent-posts__part">
                                    <div class="recent-posts__thumb">
                                        <img src="{{ asset($news->image) }}" alt="image">
                                    </div>
                                    <div class="recent-posts__title">
                                        <h5><a href="{{ url('news/details/' . $news->id . '/' . $news->slug) }}">
                                             @if (session()->get('lang') == 'ru')
                                                {{ $news->title_ru }}
                                            @elseif(session()->get('lang') == 'en')
                                                {{ $news->title_en }}
                                            @else
                                                {{ $news->title_tj }}
                                            @endif
                                        </a></h5>
                                        <a href="{{ url('news/details/' . $news->id . '/' . $news->slug) }}" class="mt_12 read_more">
                                             @if (session()->get('lang') == 'ru')
                                                   Читать далее
                                                @elseif(session()->get('lang') == 'en')
                                                 Readmore
                                                @else
                                                   Бештар
                                                @endif
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                               
                          
                            </div>
                        </div>
                     
                      
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog details end -->


<style>  


    div {
          white-space: normal;
        word-wrap: break-word;
         line-height: 1.1;
    }



</style>
@endsection
