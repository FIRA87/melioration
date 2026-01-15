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
                            <div class="service-icon me-3" style="width: 60px; height: 60px; background: #28a745; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
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
                <form action="{{ route('frontend.service.request') }}" method="POST" class="form_service_ajax" id="serviceRequestForm">
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
                        <input type="text" class="form-control" name="fio" required>
                        <span class="text-danger error-text fio_error"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Телефон <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="phone" required>
                        <span class="text-danger error-text phone_error"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Комментарий
                        </label>
                        <textarea class="form-control" name="comment" rows="3"></textarea>
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

    // AJAX-отправка формы заявки на услугу
    (function($) {
        $(".form_service_ajax").on('submit', function(e) {
            e.preventDefault();

            let form = this;
            let submitButton = $(form).find('button[type="submit"]');
            let originalText = submitButton.html();

            // Блокируем кнопку и показываем индикатор
            submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Отправка...');

            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                contentType: false,
                dataType: 'json',

                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                },

                success: function(data) {
                    // Восстанавливаем кнопку
                    submitButton.prop('disabled', false).html(originalText);

                    if (data.code == 0) {
                        // Показываем ошибки валидации
                        $.each(data.error_message, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                        
                        // Показываем общую ошибку через toastr
                        toastr.error('Пожалуйста, исправьте ошибки в форме', 'Ошибка валидации');
                        
                    } else if (data.code == 1) {
                        // Успешно: сбрасываем форму и закрываем модалку
                        form.reset();
                        const modalInstance = bootstrap.Modal.getInstance(document.getElementById('serviceModal'));
                        modalInstance.hide();

                        // Показываем уведомление через toastr
                        toastr.success(data.success_message, 'Успешно!');

                        // Перезагружаем страницу через 2.5 секунды
                        setTimeout(function() {
                            window.location.reload();
                        }, 2500);
                    }
                },

                error: function(xhr, status, error) {
                    submitButton.prop('disabled', false).html(originalText);

                    // Показываем ошибку через toastr
                    toastr.error('Не удалось отправить заявку. Попробуйте позже.', 'Ошибка сервера');
                }
            });
        });

        // Очистка формы при закрытии модального окна
        document.getElementById('serviceModal').addEventListener('hidden.bs.modal', function () {
            $('#serviceRequestForm')[0].reset();
            $('#serviceRequestForm').find('span.error-text').text('');
        });
    })(jQuery);
</script>

<div id="loader"></div>

@endsection
