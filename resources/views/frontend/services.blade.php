@extends('frontend.master')

@section('title')
    @if(session()->get('lang') == 'ru')
        Услуги
    @elseif(session()->get('lang') == 'en')
        Services
    @else
        Хизматрасонӣ
    @endif
@endsection

@php
    $siteSettings = App\Models\Setting::find(1);
@endphp

@section('content')

<!-- Banner Start -->
<section class="banner">
    <div class="container">
        <div class="row gy-4 gy-sm-0 align-items-center">
            <div class="col-sm-12">
                <div class="banner__content">
                    <h1 class="banner__title display-4 wow fadeInLeft" data-wow-duration="0.8s">
                        @if(session()->get('lang') == 'ru')
                            Услуги
                        @elseif(session()->get('lang') == 'en')
                            Services
                        @else
                            Хизматрасонӣ
                        @endif
                    </h1>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner End -->

<!-- Services Grid Start -->
<section class="section">
    <div class="container">

        
        <div class="row g-4">
            @foreach($services as $service)
                <div class="col-12 col-md-4 wow fadeInUp" data-wow-duration="0.8s">
                    <div class="service-card h-100 p-4 rounded-3" style="background: #f8f9fa; border: 1px solid #e0e0e0;">
                        <div class="d-flex align-items-start mb-3">
                          <div class="service-icon me-3">
                                <i class="bi bi-check-circle-fill text-white fs-3"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="service-title mb-2">
                                    @if(session()->get('lang') == 'ru')
                                        {{ $service->title_ru }}
                                    @elseif(session()->get('lang') == 'en')
                                        {{ $service->title_en }}
                                    @else
                                        {{ $service->title_tj }}
                                    @endif
                                </h5>
                                @if($service->description_ru || $service->description_en || $service->description_tj)
                                    <p class="text-muted small mb-0">
                                        @if(session()->get('lang') == 'ru')
                                            {{ Str::limit($service->description_ru, 150) }}
                                        @elseif(session()->get('lang') == 'en')
                                            {{ Str::limit($service->description_en, 150) }}
                                        @else
                                            {{ Str::limit($service->description_tj, 150) }}
                                        @endif
                                    </p>
                                @endif
                            </div>
                        </div>
                        
                        <button 
                            type="button" 
                            class="btn btn-outline-success w-100 order-service-btn"
                            data-service-id="{{ $service->id }}"
                            data-service-name="@if(session()->get('lang') == 'ru'){{ $service->title_ru }}@elseif(session()->get('lang') == 'en'){{ $service->title_en }}@else{{ $service->title_tj }}@endif"
                        >
                            @if(session()->get('lang') == 'ru')
                                Заказать услугу
                            @elseif(session()->get('lang') == 'en')
                                Order Service
                            @else
                                Фармоиш додан
                            @endif
                        </button>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Services Grid End -->

<!-- Modal -->
<div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel">
                    @if(session()->get('lang') == 'ru')
                        Заказать услугу
                    @elseif(session()->get('lang') == 'en')
                        Order Service
                    @else
                        Фармоиш додани хизмат
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
            <form action="{{ route('frontend.service.request') }}" method="POST" id="serviceRequestForm">
                @csrf
    
                <div class="mb-3">
                    <label class="form-label">
                        @if(session()->get('lang') == 'ru')
                            Услуга
                        @elseif(session()->get('lang') == 'en')
                            Service
                        @else
                            Хизмат
                        @endif
                    </label>
                    <input type="text" class="form-control" id="service_name_display" readonly>
                    <input type="hidden" name="service_id" id="service_id_input">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        ФИО <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('fio') is-invalid @enderror" name="fio" value="{{ old('fio') }}" required>
                    @error('fio')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Телефон <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Комментарий
                    </label>
                    <textarea class="form-control" name="comment" rows="3">{{ old('comment') }}</textarea>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success">
                        Отправить заявку
                    </button>
                </div>
            </form>
            </div>

        </div>
    </div>
</div>

<style>
    .service-card {
        transition: 0.3s ease;
    }
    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
</style>

<script>
    document.querySelectorAll('.order-service-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const serviceId = this.dataset.serviceId;
            const serviceName = this.dataset.serviceName;

            document.getElementById('service_id_input').value = serviceId;
            document.getElementById('service_name_display').value = serviceName;

            const modal = new bootstrap.Modal(document.getElementById('serviceModal'));
            modal.show();
        });
    });

    // Очистка формы при закрытии модального окна
    document.getElementById('serviceModal').addEventListener('hidden.bs.modal', function () {
        document.getElementById('serviceRequestForm').reset();
        // Очищаем ошибки валидации
        document.querySelectorAll('.error-text').forEach(el => el.textContent = '');
    });
</script>

<div id="loader"></div>


<style>

.service-icon {
    width: 60px !important;
    height: 60px !important;
    min-width: 60px !important;
    min-height: 60px !important;
    background: #28a745;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0; /* важно — чтобы размер не менялся */
}

.service-icon i {
    font-size: 28px; /* одинаковый размер галочки */
}

</style>

@endsection
