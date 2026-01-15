@extends('admin.admin_dashboard')
@section('admin')
@if(auth()->user()->hasRole('Super Admin') OR auth()->user()->hasRole('admin') OR auth()->user()->hasRole('Editor') )
 
<div class="container py-4">
    <h3>Создать опрос</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('surveys.store') }}">
        @csrf

        <div class="mb-3">
            <label>Заголовок (RU)</label>
            <input name="title_ru" class="form-control" value="{{ old('title_ru') }}" required>
        </div>
        <div class="mb-3">
            <label>Заголовок (TJ)</label>
            <input name="title_tj" class="form-control" value="{{ old('title_tj') }}">
        </div>
        <div class="mb-3">
            <label>Заголовок (EN)</label>
            <input name="title_en" class="form-control" value="{{ old('title_en') }}" required>
        </div>

        <div class="mb-3">
            <label>Описание (RU)</label>
            <textarea name="description_ru" class="form-control">{{ old('description_ru') }}</textarea>
        </div>
        <div class="mb-3">
            <label>Описание (TJ)</label>
            <textarea name="description_tj" class="form-control">{{ old('description_tj') }}</textarea>
        </div>
        <div class="mb-3">
            <label>Описание (EN)</label>
            <textarea name="description_en" class="form-control">{{ old('description_en') }}</textarea>
        </div>

        <div>
            <h5>Вопросы и варианты</h5>
            <div id="questions-wrapper"></div>
            <button type="button" class="btn btn-sm btn-secondary" id="add-question">Добавить вопрос</button>
        </div>

        <div class="mt-3">
            <label><input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}> Активен</label>
        </div>

        <div class="mt-3">
            <button class="btn btn-success">Создать</button>
            <a href="{{ route('surveys.index') }}" class="btn btn-secondary">Отмена</a>
        </div>
    </form>
</div>

<script>
    (function() {
        let qIndex = 0;

        function optionHtml(qIdx, oIdx) {
            return `
    <div class="option-item mb-1" data-q="${qIdx}" data-o="${oIdx}">
        <div class="row g-2">
            <div class="col-md-4"><input name="questions[${qIdx}][options][${oIdx}][text_ru]" class="form-control" placeholder="Опция RU" required></div>
            <div class="col-md-4"><input name="questions[${qIdx}][options][${oIdx}][text_tj]" class="form-control" placeholder="Опция TJ"></div>
            <div class="col-md-4"><input name="questions[${qIdx}][options][${oIdx}][text_en]" class="form-control" placeholder="Опция EN"></div>
        </div>
    </div>`;
        }

        function questionHtml(idx) {
            return `
    <div class="card mb-2 p-3 question-card" data-q="${idx}">
        <div class="d-flex justify-content-between">
            <h6>Вопрос #${idx+1}</h6>
            <button type="button" class="btn btn-sm btn-danger remove-question">Удалить</button>
        </div>

        <div class="mb-2"><input name="questions[${idx}][text_ru]" class="form-control" placeholder="Текст вопроса RU" required></div>
        <div class="mb-2"><input name="questions[${idx}][text_tj]" class="form-control" placeholder="Текст вопроса TJ"></div>
        <div class="mb-2"><input name="questions[${idx}][text_en]" class="form-control" placeholder="Текст вопроса EN"></div>

        <div class="mb-2">
            <label>Тип: </label>
            <select name="questions[${idx}][type]" class="form-select w-auto d-inline-block">
                <option value="radio">Один выбор (radio)</option>
                <option value="checkbox">Множественный (checkbox)</option>
                <option value="text">Текстовый</option>
            </select>
        </div>

        <div class="options-list mb-2"></div>
        <button type="button" class="btn btn-sm btn-outline-secondary add-option">Добавить вариант</button>
    </div>`;
        }

        document.getElementById('add-question').addEventListener('click', function() {
            const wrapper = document.getElementById('questions-wrapper');
            const div = document.createElement('div');
            div.innerHTML = questionHtml(qIndex);
            wrapper.appendChild(div);
            // add first option
            const card = wrapper.querySelector(`[data-q="${qIndex}"]`);
            card.querySelector('.options-list').insertAdjacentHTML('beforeend', optionHtml(qIndex, 0));
            bindQuestionEvents(card);
            qIndex++;
        });

        function bindQuestionEvents(card) {
            card.querySelector('.add-option').addEventListener('click', function() {
                const qIdx = card.getAttribute('data-q');
                const opts = card.querySelectorAll('.option-item');
                const oIdx = opts.length;
                card.querySelector('.options-list').insertAdjacentHTML('beforeend', optionHtml(qIdx, oIdx));
            });
            card.querySelector('.remove-question').addEventListener('click', function() {
                card.remove();
            });
        }
    })();
</script>

@else
<div class="d-flex align-items-center p-3 mb-3 rounded-3" style="background:#fff3f3; border:1px solid #f5c2c7;">
    <i class="fa-solid fa-lock text-danger fs-4 me-2"></i>
    <div class="text-danger fw-semibold">У вас нет доступа!</div>
</div>

@endif
@endsection
