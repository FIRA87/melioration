@extends('frontend.master')

@section('title')
    @trans('apply')   
@endsection


@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('frontend.jobs.index') }}">@trans('vacancies') </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('frontend.jobs.show', $job->slug) }}">
                            {{ $job->{'title_'.app()->getLocale()} }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active">@trans('apply')         </li>
                </ol>
            </nav>

            <div class="card shadow">
                <div class="card-header bg-primary">
                    <h3 class="mb-0 text-white">
                        @if(session()->get('lang') == 'ru')
                            Подать заявку на вакансию
                        @elseif(session()->get('lang') == 'en')
                            Apply for Vacancy
                        @else
                            Ариза додан барои ҷои корӣ
                        @endif
                    </h3>
                    <p class="mb-0 mt-2 text-white">{{ $job->{'title_'.app()->getLocale()} }}</p>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('frontend.jobs.submit') }}" method="POST" enctype="multipart/form-data" id="jobApplicationForm">
                        @csrf
                        <input type="hidden" name="job_id" value="{{ $job->id }}">

                        <!-- Личные данные -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3">
                                    @if(session()->get('lang') == 'ru')
                                        Личные данные
                                    @elseif(session()->get('lang') == 'en')
                                        Personal Information
                                    @else
                                        Маълумоти шахсӣ
                                    @endif
                                </h5>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">
                                    @if(session()->get('lang') == 'ru')
                                        Имя
                                    @elseif(session()->get('lang') == 'en')
                                        First Name
                                    @else
                                        Ном
                                    @endif
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                       id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">
                                    @if(session()->get('lang') == 'ru')
                                        Фамилия
                                    @elseif(session()->get('lang') == 'en')
                                        Last Name
                                    @else
                                        Насаб
                                    @endif
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                       id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">
                                    @if(session()->get('lang') == 'ru')
                                        Email
                                    @elseif(session()->get('lang') == 'en')
                                        Email
                                    @else
                                        Почтаи электронӣ
                                    @endif
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">
                                    @if(session()->get('lang') == 'ru')
                                        Телефон
                                    @elseif(session()->get('lang') == 'en')
                                        Phone
                                    @else
                                        Телефон
                                    @endif
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone') }}" 
                                       placeholder="+992 XXX XX XX XX" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Сопроводительное письмо -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3">
                                    @if(session()->get('lang') == 'ru')
                                        Сопроводительное письмо
                                    @elseif(session()->get('lang') == 'en')
                                        Cover Letter
                                    @else
                                        Мактуби ҳамроҳкунанда
                                    @endif
                                </h5>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="cover_letter" class="form-label">
                                    @if(session()->get('lang') == 'ru')
                                        Расскажите о себе и почему вы хотите работать у нас
                                    @elseif(session()->get('lang') == 'en')
                                        Tell us about yourself and why you want to work with us
                                    @else
                                        Дар бораи худ нависед ва чаро мехоҳед дар назди мо кор кунед
                                    @endif
                                </label>
                                <textarea class="form-control @error('cover_letter') is-invalid @enderror" 
                                          id="cover_letter" name="cover_letter" rows="6" 
                                          placeholder="@if(session()->get('lang') == 'ru')Введите ваше сопроводительное письмо...@elseif(session()->get('lang') == 'en')Enter your cover letter...@elseМактуби ҳамроҳкунандаи худро ворид кунед...@endif">{{ old('cover_letter') }}</textarea>
                                @error('cover_letter')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">
                                    @if(session()->get('lang') == 'ru')
                                        Максимум 5000 символов
                                    @elseif(session()->get('lang') == 'en')
                                        Maximum 5000 characters
                                    @else
                                        Ҳадди аксар 5000 аломат
                                    @endif
                                </small>
                            </div>
                        </div>

                        <!-- Документы -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3">
                                    @if(session()->get('lang') == 'ru')
                                        Документы
                                    @elseif(session()->get('lang') == 'en')
                                        Documents
                                    @else
                                        Ҳуҷҷатҳо
                                    @endif
                                </h5>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="resume" class="form-label">
                                    @if(session()->get('lang') == 'ru')
                                        Резюме (CV)
                                    @elseif(session()->get('lang') == 'en')
                                        Resume (CV)
                                    @else
                                        Резюме (CV)
                                    @endif
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="file" class="form-control @error('resume') is-invalid @enderror" 
                                       id="resume" name="resume" accept=".pdf,.doc,.docx" required>
                                @error('resume')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">
                                    @if(session()->get('lang') == 'ru')
                                        Форматы: PDF, DOC, DOCX. Максимальный размер: 5MB
                                    @elseif(session()->get('lang') == 'en')
                                        Formats: PDF, DOC, DOCX. Maximum size: 5MB
                                    @else
                                        Форматҳо: PDF, DOC, DOCX. Ҳаҷми максималӣ: 5MB
                                    @endif
                                </small>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="additional_files" class="form-label">
                                    @if(session()->get('lang') == 'ru')
                                        Дополнительные документы
                                    @elseif(session()->get('lang') == 'en')
                                        Additional Documents
                                    @else
                                        Ҳуҷҷатҳои иловагӣ
                                    @endif
                                </label>
                                <input type="file" class="form-control @error('additional_files.*') is-invalid @enderror" 
                                       id="additional_files" name="additional_files[]" 
                                       accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" multiple>
                                @error('additional_files.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">
                                    @if(session()->get('lang') == 'ru')
                                        Портфолио, сертификаты, рекомендации и т.д. Можно загрузить несколько файлов
                                    @elseif(session()->get('lang') == 'en')
                                        Portfolio, certificates, recommendations, etc. Multiple files can be uploaded
                                    @else
                                        Портфолио, сертификатҳо, тавсияномаҳо ва ғайра. Чанд файл бор кардан мумкин аст
                                    @endif
                                </small>
                            </div>
                        </div>

                        <!-- Кнопки -->
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-success btn-lg me-2">
                                    <i class="fas fa-paper-plane"></i>
                                    @if(session()->get('lang') == 'ru')
                                        Отправить заявку
                                    @elseif(session()->get('lang') == 'en')
                                        Submit Application
                                    @else
                                        Ариза фиристодан
                                    @endif
                                </button>
                                <a href="{{ route('frontend.jobs.show', $job->slug) }}" class="btn btn-secondary btn-lg">
                                    <i class="fas fa-times"></i>
                                    @if(session()->get('lang') == 'ru')
                                        Отмена
                                    @elseif(session()->get('lang') == 'en')
                                        Cancel
                                    @else
                                        Бекор кардан
                                    @endif
                                </a>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <small class="text-muted">
                                    <span class="text-danger">*</span>
                                    @if(session()->get('lang') == 'ru')
                                        Обязательные поля
                                    @elseif(session()->get('lang') == 'en')
                                        Required fields
                                    @else
                                        Майдoнҳои ҳатмӣ
                                    @endif
                                </small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Информация о вакансии -->
            <div class="card mt-4 bg-light">
                <div class="card-body">
                    <h5>
                        @if(session()->get('lang') == 'ru')
                            О вакансии
                        @elseif(session()->get('lang') == 'en')
                            About the Vacancy
                        @else
                            Дар бораи ҷои корӣ
                        @endif
                    </h5>
                    <p class="mb-1">
                        <strong>
                            @if(session()->get('lang') == 'ru')
                                Позиция
                            @elseif(session()->get('lang') == 'en')
                                Position
                            @else
                                Мақом
                            @endif:
                        </strong> {{ $job->{'title_'.app()->getLocale()} }}
                    </p>
                    @if($job->location)
                        <p class="mb-1">
                            <strong>
                                @if(session()->get('lang') == 'ru')
                                    Местоположение
                                @elseif(session()->get('lang') == 'en')
                                    Location
                                @else
                                    Ҷойгиршавӣ
                                @endif:
                            </strong> {{ $job->location }}
                        </p>
                    @endif
                    @if($job->salary)
                        <p class="mb-1">
                            <strong>
                                @if(session()->get('lang') == 'ru')
                                    Зарплата
                                @elseif(session()->get('lang') == 'en')
                                    Salary
                                @else
                                    Музди меҳнат
                                @endif:
                            </strong> {{ $job->salary }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label {
        font-weight: 600;
    }
    .card {
        border-radius: 10px;
    }
    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }
</style>

<script>
document.getElementById('jobApplicationForm').addEventListener('submit', function(e) {
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    
    const lang = '{{ session()->get("lang") ?? "tj" }}';
    let loadingText = '';
    if (lang === 'ru') {
        loadingText = '<i class="fas fa-spinner fa-spin"></i> Отправка...';
    } else if (lang === 'en') {
        loadingText = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
    } else {
        loadingText = '<i class="fas fa-spinner fa-spin"></i> Фиристода мешавад...';
    }
    
    submitBtn.innerHTML = loadingText;
});
</script>
@endsection