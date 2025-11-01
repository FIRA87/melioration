@extends('frontend.master')

@section('title')
    {{ $lang = session()->get('lang') }}
    {{ $lang == 'ru' ? 'Поиск' : ($lang == 'en' ? 'Search' : 'Ҷустуҷӯ...') }}
@endsection

@php
    $categories = App\Models\Category::orderBy('id', 'ASC')->get();
    $lang = session()->get('lang');
    $translations = [
        'search' => ['ru' => 'Поиск', 'en' => 'Search', 'tj' => 'Ҷустуҷӯ'],
        'categories' => ['ru' => 'Категории', 'en' => 'Categories', 'tj' => 'Категорияҳо'],
        'read_more' => ['ru' => 'Подробнее', 'en' => 'Read more', 'tj' => 'Бештар'],
        'not_found' => [
            'ru' => 'По вашему запросу ничего не найдено!!!',
            'en' => 'Nothing found for your request!!!',
            'tj' => 'Барои дархости шумо чизе ёфт нашуд!!!'
        ],
        'placeholder' => ['ru' => 'Поиск', 'en' => 'Search', 'tj' => 'Ҷустуҷӯ']
    ];
@endphp

@section('content')
    <!-- Banner Start -->
    <section class="banner">
        <div class="container">
            <div class="row gy-4 gy-sm-0 align-items-center">
                <div class="col-12 col-sm-6">
                    <div class="banner__content">
                        <h1 class="banner__title display-4 wow fadeInLeft" data-wow-duration="0.8s">
                            {{ $translations['search'][$lang] ?? $translations['search']['tj'] }}
                        </h1>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="banner__thumb text-end">
                        <img src="/frontend/assets/images/blog_banner.png" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner End -->

    <!-- Blog start -->
    <section class="blog section">
        <div class="container">
            @php
                $news = $lang == 'ru' ? $news_ru : ($lang == 'en' ? $news_en : $news_tj);
                $title_field = "title_$lang";
                $not_found_msg = $translations['not_found'][$lang] ?? $translations['not_found']['tj'];
                $search_title = $translations['search'][$lang] ?? $translations['search']['tj'];
                $categories_title = $translations['categories'][$lang] ?? $translations['categories']['tj'];
                $read_more = $translations['read_more'][$lang] ?? $translations['read_more']['tj'];
                $placeholder = $translations['placeholder'][$lang] ?? $translations['placeholder']['tj'];
                $category_field = "title_$lang";
            @endphp

            <div class="row gy-5 gy-lg-0">
                <div class="col-12 col-lg-7 col-xl-8">
                    <div class="row g-4">
                        @forelse($news as $item)
                            <div class="col-12 col-xl-6">
                                <div class="card card--secondary wow fadeInUp" data-wow-duration="0.8s">
                                    <a href="blog-details.html" class="card--secondary__thumb zoom_effect">
                                        <img src="{{ asset($item->image) }}" alt="image">
                                    </a>
                                    <div class="card--secondary__content">
                                        <p class="card--secondary__time mb-4">
                                            <span class="gap-6"><i class="bi bi-person-circle"></i>Fingram</span>
                                            <i class="bi bi-dot"></i>
                                            <span class="gap-6">
                                                <i class="bi bi-calendar3"></i>
                                                {{ date('d.m.Y', strtotime($item->created_at)) }}
                                            </span>
                                        </p>
                                        <h4>
                                            <a href="{{ url('news/details/'.$item->id.'/'.$item->slug) }}">{{ $item->$title_field }}</a>
                                        </h4>
                                        <a href="{{ url('news/details/'.$item->id.'/'.$item->slug) }}" class="mt_32 read_more">
                                            {{ $read_more }} <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <h4 class="text-center" style="color: #dc3545">{{ $not_found_msg }}</h4>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="col-12 col-lg-5 col-xl-4">
                    <div class="sidebar cus_scrollbar wow fadeInDown" data-wow-duration="0.8s">
                        <div class="sidebar__part">
                            <h4 class="sidebar__part-title">{{ $search_title }}</h4>
                            <form action="{{ route('news.search') }}" method="POST" id="filter_search" class="filter__search">
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control bg-transparent p-3" 
                                           placeholder="{{ $placeholder }}" name="search" required>
                                    <button type="submit" class="search_icon"><i class="bi bi-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="sidebar__part">
                            <h4 class="sidebar__part-title">{{ $categories_title }}</h4>
                            <ul class="category">
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ url('news/category/' . $category->id . '/' . $category->category_slug) }}">
                                            <span class="caregory__icon">
                                                <img src="/{{ $category->icon }}" alt="img" class="loan-thumb">
                                            </span>
                                            <span class="caregory__content">{{ $category->$category_field }}</span>
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