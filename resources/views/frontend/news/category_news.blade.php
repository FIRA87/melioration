@extends('frontend.master')

@section('title')
    @if(session()->get('lang') == 'ru') {{ $breadcat->title_ru }} @elseif(session()->get('lang') == 'en') {{ $breadcat->title_en }} @else {{ $breadcat->title_tj }} @endif
@endsection

@php
    $categories = App\Models\Category::orderBy('id', 'ASC')->get();
@endphp
@section('content')
  


  <!-- Banner Start -->
    <section class="banner">
        <div class="container ">
            <div class="row gy-4 gy-sm-0 align-items-center">
                <div class="col-12 col-sm-9">
                    <div class="banner__content">
                        <h1 class="banner__title display-4 wow fadeInLeft fw-bold" data-wow-duration="0.8s">
                                 @if(session()->get('lang') == 'ru') 
                                    {{ $breadcat->title_ru }}
                                @elseif(session()->get('lang') == 'en') 
                                    {{ $breadcat->title_en }} 
                                @else 
                                    {{ $breadcat->title_tj }}
                                @endif
                        </h1> 
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
                                <li class="breadcrumb-item">
                                @if(session()->get('lang') == 'ru') 
                                   Категория
                                @elseif(session()->get('lang') == 'en') 
                                   Category
                                @else 
                                    Категория
                                @endif
                              </li>
                                <li class="breadcrumb-item">
                                @if(session()->get('lang') == 'ru') 
                                    {{ $breadcat->title_ru }}
                                @elseif(session()->get('lang') == 'en') 
                                    {{ $breadcat->title_en }} 
                                @else 
                                    {{ $breadcat->title_tj }}
                                @endif
                                </li>
                 
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="banner__thumb text-end">
                        <img src="{{ asset('frontend/assets/images/blog_banner.png')}}" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner End -->

    <!-- Blog start -->
    <section class="blog section">
        <div class="container ">
            <div class="row gy-5 gy-lg-0">
                <div class="col-12 col-lg-7 col-xl-8">
                    <div class="row g-4">

                        @forelse($news as $item)
                            <div class="col-12 col-xl-6">
                                <div class="card card--secondary wow fadeInUp" data-wow-duration="0.8s">
                                    <a href="blog-details.html" class="card--secondary__thumb zoom_effect">
                                        <img src="{{ asset( $item->image) }}" alt="image">
                                    </a>
                                    <div class="card--secondary__content">
                                        <p class="card--secondary__time mb-4"><span class="gap-6"><i class="bi bi-person-circle"></i>Fingram</span><i class="bi bi-dot"></i> <span class="gap-6"><i class="bi bi-calendar3"></i>
                                                 @php
                                                $my_time = strtotime($item->created_at);
                                                $update_date = date('d.m.Y',$my_time);
                                            @endphp
                                            {{ $update_date }}
                                         </span></p>
                                        <h4><a href="{{ url('news/details/'.$item->id.'/'.$item->slug) }}">
                                              @if(session()->get('lang') == 'ru') 
                                                    {{ $item->title_ru }} 
                                              @elseif(session()->get('lang') == 'en') 
                                                    {{ $item->title_en }} 
                                              @else 
                                                    {{ $item->title_tj }}
                                              @endif
                                        </a></h4>
                                       
                                        <a href="{{ url('news/details/'.$item->id.'/'.$item->slug) }}" class="mt_32 read_more">
                                               @if (session()->get('lang') == 'ru')
                                                Подробнее
                                            @elseif(session()->get('lang') == 'en')
                                                Read more
                                            @else
                                                Бештар
                                            @endif
                                         <i class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @empty
                              <p>No posted   </p>
                        @endforelse
                    
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <nav aria-label="Page navigation" class="nav_pagination wow fadeInUp" data-wow-duration="0.8s">                             
                                     {{ $news->links() }}     
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5 col-xl-4">
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
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog end -->



@endsection
