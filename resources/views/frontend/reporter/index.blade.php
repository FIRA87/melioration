@extends('frontend.master')

@section('title')
  Reporter
@endsection


@section('content')
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">
                   Автор - {{ $reporter->name }}
                </h1>
            </div>
        </div>
    </div>

    <!-- Blog Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Blog list Start -->
                <div class="col-lg-12">
                    <div class="row g-5">
                        @forelse($news as $item)
                            <div class="col-md-4 wow slideInUp d-flex align-items-stretch" data-wow-delay="0.1s">
                                <div class="blog-item bg-light rounded overflow-hidden">
                                    <div class="blog-img position-relative overflow-hidden">
                                        <img class="card-img" src="{{ asset( $item->image) }}" alt="Bologna">

                                    </div>
                                    <div class="p-4">
                                        <div class="d-flex mb-3">
                                            <small class="me-3"><i class="far fa-user text-primary me-2"></i>{{ $item->user->name }}</small>
                                            <small class="me-3"><i class="bi bi-eye" style="color: #06a3da;"></i> {{ $item->views }}</small>
                                            <small><i class="far fa-calendar-alt text-primary me-2"></i>
                                                @php
                                                    $my_time = strtotime($item->created_at);
                                                    $update_date = date('d.m.Y',$my_time);
                                                @endphp
                                                {{ $update_date }}
                                            </small>
                                        </div>
                                        <h4 class="mb-3">
                                            @if(session()->get('lang') == 'ru') {{ $item->title_ru }} @elseif(session()->get('lang') == 'en') {{ $item->title_en }} @else {{ $item->title_tj }} @endif
                                        </h4>

                                        <a class="text-uppercase" href="{{ url('news/details/'.$item->id.'/'.$item->slug) }}">Read More <i class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="conversation-text">
                                <div class="ctext-wrap">
                                    <p>No posted   </p>
                                </div>
                            </div>
                        @endforelse
                        <div class="col-12 wow slideInUp" data-wow-delay="0.1s">
                            {{ $news->links() }}
                        </div>
                    </div>
                </div>
                <!-- Blog list End -->

            </div>
        </div>
    </div>
    <!-- Blog End -->
@endsection
