@extends('frontend.master')
@section('content')
@php
	$latestNews = App\Models\News::orderBy('publish_date', 'desc')->limit(3)->get();
@endphp


<!-- Hero -->
<section class="py-5">
  <div class="container">
    <div class="row g-4 align-items-stretch">
          
      <div class="col-12 col-lg-8">
        
        <div class="hero-card bg-light small-card position-relative" id="heroSlider">
             @if (is_countable($sliders) && count($sliders) > 0)
                @foreach ($sliders as $key => $news)
          <div class="hero-bg {{ $key === 0 ? 'active' : '' }}" style="background-image:url('{{ asset($news->image) }}')">
            <div>
              <div class="hero-title">
                    @if (session()->get('lang') == 'ru')
                        {{ $news->title_ru }}
                    @elseif(session()->get('lang') == 'en')
                        {{ $news->title_en }}
                    @else                 
                        {{ $news->title_tj }}
                    @endif
              </div>
              <div class="mt-3"><a href="{{ url('news/details/' . $news->id ) }}" class="btn btn-sm">@trans('read_more') →</a></div>
            </div>
          </div>
             @endforeach
            @endif
        </div>
       
      </div>
       
      <div class="col-12 col-lg-4">
         @if (is_countable($prezident) && count($prezident) > 0)
                @foreach ($prezident as $item)
        <div class="small-card h-100 bg-white shadow-sm">
          <img src="{{ asset($item->image) }}" alt="portrait" style="width:100%;object-fit:cover;border-radius:8px;"/>        
          <p class="text-muted small" style="padding: 10px;">
             <a href="{{ url('prezident/detail/' . $item->id ) }}" class="text-decoration-none" style="color: #000 !important; text-decoration: none !important;padding: 10px;"> 
              @if (session()->get('lang') == 'ru')              
                    {!! Str::limit(strip_tags($item->text_ru), 200) !!}
                @elseif(session()->get('lang') == 'en')
                    {!! Str::limit(strip_tags($item->text_en), 200) !!}
                @else                 
                  {!! Str::limit(strip_tags($item->text_tj), 200) !!}
                @endif</a>
          </p>
        </div>
           @endforeach
            @endif
      </div>
    </div>
  </div>
</section>


<!-- Секция "Основные обязанности" -->

@if($home_page2 && $home_page2->tasks->count() > 0)
<section class="py-5 py-md-6" style="background: #F7F5EF;">
    <div class="container">
        <!-- Заголовок + ссылка "Узнать больше" -->
        <div class="row align-items-start mb-4 mb-md-5">
            <div class="col-lg-10 col-12">
                <h2 class="fw-bold text-uppercase mb-3 mb-md-4" 
                    style="font-size: clamp(28px, 5vw, 36px);">
                     @trans('main_responsibilities')
                </h2>

                <p class="text-muted mb-4 mb-md-0" style="font-size: clamp(15px, 2.5vw, 15px); line-height: 1.8;">
                    @if(session()->get('lang') == 'ru')
                        {!! Str::limit(strip_tags($home_page2->news_details_ru), 250) !!}
                    @elseif(session()->get('lang') == 'en')
                        {!! Str::limit(strip_tags($home_page2->news_details_en), 250) !!}
                    @else
                        {!! Str::limit(strip_tags($home_page2->news_details_tj), 250) !!}
                    @endif
                </p>
            </div>

            <!-- Ссылка "Узнать больше" — на мобильных под текстом, на десктопе справа -->
            <div class="col-lg-2 col-12 text-lg-end mt-3 mt-lg-0">
                <a href="{{ url('news/details/'.$home_page2->id) }}" class="fw-semibold d-inline-block" style="color:#0A8250; text-decoration:none; font-size: clamp(15px, 2.5vw, 15px);">
                     @trans('learn_more') →
                    
                </a>
            </div>
        </div>

        <!-- Сбор всех элементов задач -->
        @php
            $allItems = collect();
            foreach($home_page2->tasks as $task) {
                if($task->items) {
                    $allItems = $allItems->merge($task->items);
                }
            }
        @endphp

        <!-- Карточки -->
        <div class="row g-4 g-xl-5">
            @foreach($allItems as $index => $item)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="p-4 rounded-4 shadow-sm h-100 d-flex align-items-start gap-3 gap-md-4" style="background:#FFFFFF; border:1px solid #E8E5D9; min-height: 120px;">
                        
                        <!-- Круглый номер — адаптивный размер -->
                        <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle text-white fw-bold"
                             style="width: clamp(48px, 8vw, 56px); 
                                    height: clamp(48px, 8vw, 56px); 
                                    background: #3B8A3F; 
                                    font-size: clamp(16px, 3vw, 18px);">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>

                        <!-- Текст -->
                        <div style="flex-grow:1;">
                            <p class="m-0" style="font-size: clamp(15px, 2.5vw, 15px); line-height: 1.65;">
                                @if(session()->get('lang') == 'ru')
                                    {!! $item->text_ru !!}
                                @elseif(session()->get('lang') == 'en')
                                    {!! $item->text_en !!}
                                @else
                                    {!! $item->text_tj !!}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Кнопка "Показать все" — только если больше 6 элементов -->
        @if($allItems->count() > 6)
            <div class="text-center mt-5 mt-md-6">
                <a href="{{ url('news/details/'.$home_page2->id.'/'.$home_page2->slug) }}"
                   class="btn btn-outline-success btn-lg px-5 py-3"
                   style="font-size: clamp(16px, 3vw, 18px);">
                     @trans('show_all_responsibilities')
                </a>
            </div>
        @endif
    </div>
</section>
@endif


<!-- Деятельность -->

<section class="py-5 bg-light">
    <div class="container">

        @foreach($home_page as $item)
            <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap">
                <h2 class="section-title mb-2 mb-md-0">
                    @if(session()->get('lang') == 'ru')
                        {{ $item->title_ru }}
                    @elseif(session()->get('lang') == 'en')
                        {{ $item->title_en }}
                    @else
                        {{ $item->title_tj }}
                    @endif
                </h2>
                <a href="{{ url('news/details/' . $item->id ) }}" class="btn btn-outline-success btn-sm">
                   @trans('learn_more')
                </a>
            </div>

            <p class="text-muted mb-4">
                @if(session()->get('lang') == 'ru')
                    {!! Str::limit(strip_tags($item->news_details_ru), 250) !!}
                @elseif(session()->get('lang') == 'en')
                    {!! Str::limit(strip_tags($item->news_details_en), 250) !!}
                @else
                    {!! Str::limit(strip_tags($item->news_details_tj), 250) !!}
                @endif
            </p>

            <!-- Галерея -->
            <div class="row g-3">
                @forelse($item->images as $img)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class=" overflow-hidden shadow-soft position-relative">
                            <img src="{{ asset($img->image) }}" class="img-fluid w-100 object-fit-cover rounded-3" style="height: 200px; transition: transform 0.3s ease;"  alt="Галерея">
                            <div class="position-absolute bottom-0 start-0 end-0" style="height: 50%; background: linear-gradient(transparent, rgba(0,0,0,0.25)); border-radius: 0 0 12px 12px;"></div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 text-muted">
                        <i class="bi bi-images" style="font-size: 3.5rem; opacity: 0.2;"></i>
                        <p class="mt-3">Дополнительные фотографии отсутствуют</p>
                    </div>
                @endforelse
            </div>
        @endforeach

    </div>
</section>

<!-- Проекты -->

<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title">@trans('projects')</h2>

        <div class="row g-4">
            @foreach($projects as $project)
                <div class="col-lg-12 col-md-6 col-sm-12">
                    <div class="project-item shadow-soft d-flex flex-column flex-md-row gap-3 p-3">
                        <!-- Изображение проекта -->
                        <div class="flex-shrink-0">
                            <img src="{{ $project->image }}" alt="{{ $project->title_ru }}" class="rounded-img object-fit-cover">
                        </div>

                        <!-- Текст -->
                        <div class="flex-grow-1 d-flex flex-column justify-content-between">
                            <h5 class="mb-2">
                                @if (session()->get('lang') == 'ru')
                                    {{ $project->title_ru }}
                                @elseif(session()->get('lang') == 'en')
                                    {{ $project->title_en }}
                                @else
                                    {{ $project->title_tj }}
                                @endif
                            </h5>
                            <p class="text-muted mb-3" style="font-size: 0.9rem;">
                                @if (session()->get('lang') == 'ru')
                                    {{ \Illuminate\Support\Str::limit(strip_tags($project->text_ru), 180) }}
                                @elseif(session()->get('lang') == 'en')
                                    {{ \Illuminate\Support\Str::limit(strip_tags($project->text_en), 180) }}
                                @else
                                    {{ \Illuminate\Support\Str::limit(strip_tags($project->text_tj), 180) }}
                                @endif
                            </p>
                            <a href="{{ route('frontend.project.detail', $project->id) }}" class="btn btn-outline-success align-self-start">
                               @trans('read_more')
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>




<!-- СЕКЦИЯ НОВОСТЕЙ - НАЧАЛО -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
           <h2 class="section-title mb-2 mb-md-0">
               <a href="{{ route('frontend.news') }}" class="fw-semibold" style="color: #000 !important; text-decoration: none !important;"> 
              @trans('main_news')
               </a>
            </h2>
           
             
            
        </div>

        <div class="row g-4">  
            @foreach($latestNews as $news)  
                <div class="col-12 col-md-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <div class="position-relative">               
            			     @if($news->images && $news->images->isNotEmpty())
                                <img src="{{ asset($news->images->first()->image) }}" class="card-img-top" style="height:220px; object-fit:cover;" alt="{{ $news->title_ru ?? $news->title_tj }}">
                            @else
                                {{-- Placeholder если нет изображений --}}
                                <img src="{{ asset('upload/no-image.jpg') }}" 
                                     class="card-img-top" 
                                     style="height:220px; object-fit:cover;"
                                     alt="No image">
                            @endif
            				
            				
                            <div class="position-absolute bottom-0 start-0 end-0" style="height:40%; background: linear-gradient(transparent, rgba(0,0,0,0.55));"></div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <p class="text-muted small mb-2">{{ $news->publish_date }}</p>
                            <h5 class="fw-bold mb-3">
                                @if (session()->get('lang') == 'ru') 
            						{{ $news->title_ru }}
                                   @elseif(session()->get('lang') == 'en')
            						{{ $news->title_en }}
                                @else 
            						{{ $news->title_tj }}
                                @endif
                            </h5>
                            <p class="text-muted mb-4">
                              @if (session()->get('lang') == 'ru') 
            						{!! Str::limit(strip_tags($news->news_details_ru ?? ''), 120) !!}
                                    @elseif(session()->get('lang') == 'en')
            						{!! Str::limit(strip_tags($news->news_details_en ?? ''), 120) !!}
                                @else 
            						{!! Str::limit(strip_tags($news->news_details_tj ?? ''), 120) !!}
                                @endif
                            </p>
                            <a href="{{ url('news/details/' . $news->id ) }}" class="mt-auto fw-semibold text-success">@trans('read_more') → </a>
                        </div>
                    </div>
                </div>
            @endforeach

           
        </div>
    </div>
</section>
<!-- СЕКЦИЯ НОВОСТЕЙ - КОНЕЦ -->




<!-- СЕКЦИЯ VIDEO - КОНЕЦ -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title fw-bold">@trans('main_video')    </h2>
            <a href="{{ url('/videos') }}" class="text-decoration-none text-success">  @trans('all_video') →  </a>
        </div>
        
        <div class="row g-3">
            @foreach($videos as $video)
                @php
                    // Конвертируем YouTube URL в embed формат
                    $videoUrl = $video->video_url;
                    
                    // Получаем YouTube ID из разных форматов URL
                    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $videoUrl, $matches)) {
                        $youtubeId = $matches[1];
                        $embedUrl = "https://www.youtube.com/embed/{$youtubeId}?autoplay=1";
                        $thumbnail = "https://img.youtube.com/vi/{$youtubeId}/maxresdefault.jpg";
                    } else {
                        // Если уже embed формат или другой источник
                        $embedUrl = $videoUrl;
                        $thumbnail = asset($video->thumbnail ?? 'upload/no-image.jpg');
                    }
                @endphp
                
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="video-card position-relative overflow-hidden rounded-4" 
                         data-bs-toggle="modal" 
                         data-bs-target="#videoModal{{ $video->id }}">
                        <!-- Превью видео -->
                        <img src="{{ $thumbnail }}"
                             alt="{{ $video->title_ru }}"
                             class="video-thumbnail"
                             onerror="this.src='{{ asset('upload/no-image.jpg') }}'">
                        
                        <!-- Затемнение -->
                        <div class="video-overlay"></div>
                        
                        <!-- Кнопка Play -->
                        <div class="video-play-btn">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none">
                                <rect width="60" height="60" rx="8" fill="white" fill-opacity="0.9"/>
                                <path d="M24 20L40 30L24 40V20Z" fill="#333"/>
                            </svg>
                        </div>
                        
                        <!-- Заголовок (опционально) -->
                        @if(isset($video->title_ru))
                        <div class="video-title">
                            @if (session('lang') == 'ru')
                                {{ Str::limit($video->title_ru, 200) }}
                            @elseif(session('lang') == 'en')
                                {{ Str::limit($video->title_en ?? $video->title_ru, 200) }}
                            @else
                                {{ Str::limit($video->title_tj ?? $video->title_ru, 200) }}
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Модальное окно для видео -->
                <div class="modal fade" id="videoModal{{ $video->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content bg-dark">
                            <div class="modal-header border-0">
                                <h5 class="modal-title text-white">
                                    @if (session('lang') == 'ru')
                                        {{ $video->title_ru ?? 'Видео' }}
                                    @elseif(session('lang') == 'en')
                                        {{ $video->title_en ?? $video->title_ru ?? 'Video' }}
                                    @else
                                        {{ $video->title_tj ?? $video->title_ru ?? 'Видео' }}
                                    @endif
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="ratio ratio-16x9">
                                    <iframe src="" 
                                            data-src="{{ $embedUrl }}"
                                            class="video-iframe"
                                            title="Video" 
                                            frameborder="0"
                                            allowfullscreen
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<!-- Фотогалерея (КАРТОЧКИ) -->

<section class="py-5 bg-white">
    <div class="container">
        <h2 class="section-title mb-5 text-center"> @trans('main_gallery')   </h2>
        <div class="row g-4">
            @foreach($galleries as $item)
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <a href="{{ url('gallery/details/'.$item->id) }}" class="text-decoration-none">
                        <div class="gallery-card shadow-sm rounded overflow-hidden position-relative">                            
                            <div class="ratio ratio-1x1"><img src="/upload/cover/{{ $item->cover }}" class="w-100 h-100 gallery-img" alt=""></div>
                            <div class="p-3 bg-white">
                                <h5 class="mb-0 text-dark text-truncate">
                                    @if(session('lang')=='ru') 
                                        {{ $item->title_ru }}
                                    @elseif(session('lang')=='en') 
                                        {{ $item->title_en }}
                                    @else 
                                         {{ $item->title_tj }} 
                                    @endif
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
</section>





<!-- Руководство -->
<div class="py-5 bg-light ">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-uppercase" style="font-size: 2rem; letter-spacing: 2px;">
               @trans('leadership')
            </h2>
            <a href="{{ route('frontend.leader') }}" class="text-decoration-none text-muted hover-link">
               @trans('learn_more')
            </a>
        </div>
        
        @if($leaders->count())
            <div class="row g-4">
                @foreach($leaders as $leader)
                    <div class="col-12 col-sm-6 col-lg-3">
                        <a href="{{ route('frontend.leader.detail', $leader->id) }}" class="text-decoration-none">
                            <div class="leader-card position-relative overflow-hidden rounded-4 shadow-sm">
                                <!-- Фото на весь размер -->
                                @if($leader->image)
                                    <img src="{{ asset($leader->image) }}"
                                         alt="{{ session('lang')=='ru' ? $leader->title_ru : (session('lang')=='en' ? $leader->title_en : $leader->title_tj) }}"
                                         class="leader-photo w-100">
                                @else
                                    <div class="leader-photo w-100 bg-secondary d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person-circle text-white" style="font-size: 80px;"></i>
                                    </div>
                                @endif
                                
                                <!-- Темный градиент снизу -->
                                <div class="leader-overlay"></div>
                                
                                <!-- Текст поверх фото внизу -->
                                <div class="leader-info">
                                    <p class="leader-name mb-1 text-white fw-semibold">
                                        @if (session('lang') == 'ru')
                                            {{ $leader->title_ru }}
                                        @elseif(session('lang') == 'en')
                                            {{ $leader->title_en }}
                                        @else
                                            {{ $leader->title_tj }}
                                        @endif
                                    </p>
                                  
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i>
                Список руководства пуст
            </div>
        @endif
    </div>
</div>



<!-- Опросник -->
<section class="survey-section">
    <div class="container">
        <div class="survey-card">        

            @foreach ($survey->questions as $question)
                <div class="question-card">
                    <h5 class="question-title">{{ $question->text_ru }}</h5>

                    @if ($question->type === 'text')
                        <form class="vote-form" data-question-id="{{ $question->id }}">
                            @csrf
                            <textarea name="text_answer" 
                                      class="survey-textarea" 
                                      placeholder="Введите ваш ответ здесь..."
                                      required></textarea>
                            <button type="submit" class="vote-btn">@trans('send_button')</button>
                            <div class="vote-result" style="display:none"></div>
                        </form>
                    @else
                        <form class="vote-form" data-question-id="{{ $question->id }}">
                            @csrf
                            <div class="options">
                                @foreach ($question->options as $opt)
                                    <label class="option-label">
                                        <input type="{{ $question->type }}" 
                                               name="option" 
                                               value="{{ $opt->id }}">
                                        <span class="option-text">{{ $opt->text_ru }}</span>
                                        <span class="option-count" data-option-id="{{ $opt->id }}">
                                            {{ $opt->answers()->count() }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                            <button type="submit" class="vote-btn">@trans('vote')</button>
                            <div class="vote-result" style="display:none"></div>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Форма обратной связи -->
<section class="contact-section">
    <div class="container">
        <h2 class="contact-title text-center">@trans('citizen_requests') </h2>

        <div class="row">
            <div class="col-md-12 mx-auto">
                <form action="{{ route('contact_form_submit') }}" method="POST" class="contact-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="name" class="contact-input" placeholder="Ф.И.О" required>
                        </div>
                        <div class="col-md-6">
                            <input type="tel" name="phone" class="contact-input" placeholder="Телефон" required>
                        </div>
                        <div class="col-md-12">
                            <input type="email" name="email" class="contact-input" placeholder="Email" required>
                        </div>
                        <div class="col-md-12">
                            <textarea name="message" class="contact-textarea" placeholder="Тема" required></textarea>
                        </div>
                       <div class="col-md-2 d-flex justify-content-center">
                            <button type="submit" class="vote-btn">@trans('send_button')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>




<section class="py-5 bg-white">
    <div class="container">
        <h3 class="fw-bold mb-4 text-uppercase">  @trans('our_partners')  </h3>

        <div class="row justify-content-between text-center text-md-start">
            @foreach($partners as $item)
            <div class="col-12 col-md-3 mb-4 d-flex align-items-center gap-3">
                <a href="{{ $item->url }}" target="_blank"><img src="{{ $item->img }}" alt="logo"  style="width: 50px;"></a>
                <span class="fw-semibold">
                    @if (session('lang') == 'ru')
                       {{ $item->title_ru }}
                    @elseif(session('lang') == 'en')
                         {{ $item->title_en }}
                    @else
                        {{ $item->title_tj }}
                    @endif
                </span>
            </div>
            @endforeach
        
        </div>

    </div>
</section>


@endsection
