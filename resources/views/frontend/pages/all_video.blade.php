@extends('frontend.master')

@section('title')
    @trans('all_video')
@endsection

@section('content')

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
      crossorigin="anonymous" />

<!-- Banner Start -->
<section class="banner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-sm-6">
                <h1 class="display-4">@trans('main_video')</h1>
            </div>
        </div>
    </div>
</section>
<!-- Banner End -->

<section class="feature feature--tertiary section">
    <div class="container">
        <div class="row g-4">

            @foreach($videos as $video)

                @php
                    $videoUrl = $video->video_url;

                    // Извлекаем YouTube ID (КЛЮЧЕВО!)
                    if (preg_match('/(?:youtube\.com\/(?:.*v=|v\/|embed\/)|youtu\.be\/)([^"&?\/\s]{11})/i', $videoUrl, $matches)) {
                        $youtubeId = $matches[1];
                        $embedUrl = "https://www.youtube.com/embed/{$youtubeId}?autoplay=1";
                        $thumbnail = "https://img.youtube.com/vi/{$youtubeId}/maxresdefault.jpg";
                    } else {
                        // fallback
                        $embedUrl = $videoUrl;
                        $thumbnail = asset($video->caption ?? 'upload/no-image.jpg');
                    }
                @endphp

                <div class="col-12 col-md-6 col-xl-3">

                    <!-- Карточка -->
                    <div class="card card--custom">
                        <div class="position-relative overflow-hidden video-trigger"
                             data-bs-toggle="modal"
                             data-bs-target="#videoModal{{ $video->id }}">

                            <img src="{{ $thumbnail }}"
                                 class="w-100"
                                 alt="Video"
                                 onerror="this.src='{{ asset('upload/no-image.jpg') }}'">

                            <div class="play-overlay">
                                <i class="fa-solid fa-circle-play"></i>
                            </div>
                        </div>

                        <div class="card__content p-3">
                            <h4 style="font-size:18px">
                                @if (session('lang') === 'ru')
                                    {{ $video->title_ru }}
                                @elseif(session('lang') === 'en')
                                    {{ $video->title_en }}
                                @else
                                    {{ $video->title_tj }}
                                @endif
                            </h4>
                        </div>
                    </div>

                </div>

                <!-- МОДАЛЬНОЕ ОКНО -->
                <div class="modal fade" id="videoModal{{ $video->id }}" tabindex="-1">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content bg-dark">
                            <div class="modal-body p-0">
                                <div class="ratio ratio-16x9">
                                    <iframe
                                        src=""
                                        data-src="{{ $embedUrl }}"
                                        class="video-iframe"
                                        frameborder="0"
                                        allow="autoplay; encrypted-media"
                                        allowfullscreen
                                        playsinline>
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>

        <div class="row mt-4">
            <div class="col-12">
                {{ $videos->links() }}
            </div>
        </div>
    </div>
</section>

<!-- СТИЛИ -->
<style>
.play-overlay {
    position: absolute;
    inset: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 64px;
    color: rgba(255,255,255,.9);
    background: rgba(0,0,0,.25);
    transition: .3s;
}

.video-trigger:hover .play-overlay {
    background: rgba(0,0,0,.45);
    transform: scale(1.05);
}

.card--custom {
    cursor: pointer;
}
</style>

<!-- JS -->
<script>
document.querySelectorAll('.modal').forEach(modal => {

    modal.addEventListener('shown.bs.modal', function () {
        const iframe = modal.querySelector('iframe');
        iframe.src = iframe.dataset.src;
    });

    modal.addEventListener('hidden.bs.modal', function () {
        const iframe = modal.querySelector('iframe');
        iframe.src = '';
    });

});
</script>

@endsection
