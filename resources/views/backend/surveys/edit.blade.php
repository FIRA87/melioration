@extends('admin.admin_dashboard')
@section('admin')
    <div class="container py-4">
        <h3>Редактировать опрос</h3>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('surveys.update', $survey) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Заголовок (RU)</label>
                <input name="title_ru" class="form-control" value="{{ old('title_ru', $survey->title_ru) }}" required>
            </div>
            <div class="mb-3">
                <label>Заголовок (TJ)</label>
                <input name="title_tj" class="form-control" value="{{ old('title_tj', $survey->title_tj) }}">
            </div>
            <div class="mb-3">
                <label>Заголовок (EN)</label>
                <input name="title_en" class="form-control" value="{{ old('title_en', $survey->title_en) }}" required>
            </div>

            <div class="mb-3">
                <label>Описание (RU)</label>
                <textarea name="description_ru" class="form-control">{{ old('description_ru', $survey->description_ru) }}</textarea>
            </div>
            <div class="mb-3">
                <label>Описание (TJ)</label>
                <textarea name="description_tj" class="form-control">{{ old('description_tj', $survey->description_tj) }}</textarea>
            </div>
            <div class="mb-3">
                <label>Описание (EN)</label>
                <textarea name="description_en" class="form-control">{{ old('description_en', $survey->description_en) }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Дата начала</label>
                    <input type="date" id="start_date" name="start_date" class="form-control"
                        value="{{ old('start_date', isset($survey->start_date) ? \Carbon\Carbon::parse($survey->start_date)->format('Y-m-d') : '') }}">
                </div>

                <div class="col-md-4">
                    <label for="end_date" class="form-label">Дата окончания</label>
                    <input type="date" id="end_date" name="end_date" class="form-control"
                        value="{{ old('end_date', isset($survey->end_date) ? \Carbon\Carbon::parse($survey->end_date)->format('Y-m-d') : '') }}">
                </div>
            </div>




            <div>
                <h5>Вопросы и варианты</h5>
                <div id="questions-wrapper">
                    @foreach ($survey->questions as $i => $question)
                        <div class="card mb-2 p-3 question-card" data-q="{{ $i }}">
                            <div class="d-flex justify-content-between">
                                <h6>Вопрос #{{ $i + 1 }}</h6>
                                <button type="button" class="btn btn-sm btn-danger remove-question">Удалить</button>
                            </div>

                            <input type="hidden" name="questions[{{ $i }}][id]" value="{{ $question->id }}">
                            <div class="mb-2"><input name="questions[{{ $i }}][text_ru]" class="form-control"
                                    value="{{ $question->text_ru }}" required></div>
                            <div class="mb-2"><input name="questions[{{ $i }}][text_tj]" class="form-control"
                                    value="{{ $question->text_tj }}"></div>
                            <div class="mb-2"><input name="questions[{{ $i }}][text_en]" class="form-control"
                                    value="{{ $question->text_en }}"></div>

                            <div class="mb-2">
                                <label>Тип: </label>
                                <select name="questions[{{ $i }}][type]"
                                    class="form-select w-auto d-inline-block">
                                    <option value="radio" {{ $question->type == 'radio' ? 'selected' : '' }}>radio
                                    </option>
                                    <option value="checkbox" {{ $question->type == 'checkbox' ? 'selected' : '' }}>checkbox
                                    </option>
                                    <option value="text" {{ $question->type == 'text' ? 'selected' : '' }}>text</option>
                                </select>
                            </div>

                            <div class="options-list mb-2">
                                @foreach ($question->options as $j => $opt)
                                    <div class="option-item mb-1" data-q="{{ $i }}"
                                        data-o="{{ $j }}">
                                        <input type="hidden"
                                            name="questions[{{ $i }}][options][{{ $j }}][id]"
                                            value="{{ $opt->id }}">
                                        <div class="row g-2">
                                            <div class="col-md-4"><input
                                                    name="questions[{{ $i }}][options][{{ $j }}][text_ru]"
                                                    class="form-control" value="{{ $opt->text_ru }}" required></div>
                                            <div class="col-md-4"><input
                                                    name="questions[{{ $i }}][options][{{ $j }}][text_tj]"
                                                    class="form-control" value="{{ $opt->text_tj }}"></div>
                                            <div class="col-md-4"><input
                                                    name="questions[{{ $i }}][options][{{ $j }}][text_en]"
                                                    class="form-control" value="{{ $opt->text_en }}"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-secondary add-option">Добавить
                                вариант</button>
                        </div>
                    @endforeach
                </div>

                <button type="button" class="btn btn-sm btn-secondary" id="add-question">Добавить вопрос</button>
            </div>

            <div class="mt-3">
                <label><input type="checkbox" name="is_active" value="1" {{ $survey->is_active ? 'checked' : '' }}>
                    Активен</label>
            </div>

            <div class="mt-3">
                <button class="btn btn-primary">Сохранить</button>
                <a href="{{ route('surveys.index') }}" class="btn btn-secondary">Назад</a>
            </div>
        </form>
    </div>

    <script>
        (function() {
            // build dynamic indices starting from existing count
            let questionsWrapper = document.getElementById('questions-wrapper');
            let qCount = questionsWrapper.querySelectorAll('.question-card').length;

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
                const div = document.createElement('div');
                div.innerHTML = questionHtml(qCount);
                questionsWrapper.appendChild(div);
                const card = questionsWrapper.querySelector(`[data-q="${qCount}"]`);
                card.querySelector('.options-list').insertAdjacentHTML('beforeend', optionHtml(qCount, 0));
                bindQuestionEvents(card);
                qCount++;
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

            // bind existing cards
            document.querySelectorAll('.question-card').forEach(bindQuestionEvents);
        })();
    </script>
@endsection
