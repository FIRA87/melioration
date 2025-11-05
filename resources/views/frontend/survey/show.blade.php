<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
</head>

<body>




    <div class="container py-4">
        <h3>{{ $survey->title_ru }}</h3>
        @if ($survey->description_ru)
            <p>{{ $survey->description_ru }}</p>
        @endif

        @foreach ($survey->questions as $question)
            <div class="card mb-3 p-3">
                <h5>{{ $question->text_ru }}</h5>

                @if ($question->type === 'text')
                    <form class="vote-form" data-question-id="{{ $question->id }}">
                        @csrf
                        <textarea name="text_answer" class="form-control mb-2" required></textarea>
                        <button class="btn btn-primary">Отправить</button>
                        <div class="vote-result mt-2 text-success" style="display:none"></div>
                    </form>
                @else
                    <form class="vote-form" data-question-id="{{ $question->id }}">
                        @csrf
                        <div class="options">
                            @foreach ($question->options as $opt)
                                <label class="d-block mb-1">
                                    <input type="{{ $question->type }}" name="option" value="{{ $opt->id }}">
                                    {{ $opt->text_ru }}
                                    <span class="badge bg-secondary option-count" data-option-id="{{ $opt->id }}">
                                        ({{ $opt->answers()->count() }})
                                    </span>
                                </label>
                            @endforeach
                        </div>
                        <button class="btn btn-primary mt-2">Голосовать</button>
                        <div class="vote-result mt-2 text-success" style="display:none"></div>
                    </form>
                @endif
            </div>
        @endforeach
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.vote-form').forEach(form => {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    const questionId = this.dataset.questionId;
                    const type = this.querySelector(
                        'input[type="radio"], input[type="checkbox"]') ? 'choice' : 'text';
                    let optionId = null;
                    let textAnswer = null;

                    if (type === 'choice') {
                        const checked = this.querySelector('input[name="option"]:checked');
                        if (!checked) {
                            alert('Выберите вариант');
                            return;
                        }
                        optionId = checked.value;
                    } else {
                        textAnswer = this.querySelector('textarea[name="text_answer"]').value
                            .trim();
                        if (!textAnswer) {
                            alert('Введите текст');
                            return;
                        }
                    }

                    const token = document.querySelector('meta[name="csrf-token"]').content;
                    try {
                        const res = await fetch(
                            "{{ url('survey') }}/{{ $survey->id }}/vote", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': token,
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    question_id: questionId,
                                    option_id: optionId,
                                    text_answer: textAnswer
                                })
                            });
                        const data = await res.json();
                        if (!res.ok) {
                            alert(data.message || 'Ошибка');
                            return;
                        }

                        data.counts.forEach(c => {
                            const el = document.querySelector(
                                '.option-count[data-option-id="' + c.option_id +
                                '"]');
                            if (el) el.textContent = '(' + c.votes + ')';
                        });

                        const resultBox = this.querySelector('.vote-result');
                        resultBox.style.display = 'block';
                        resultBox.textContent = 'Спасибо! Всего голосов: ' + data.total;
                        this.querySelectorAll('input,textarea,button').forEach(el => el
                            .disabled = true);
                    } catch (err) {
                        console.error(err);
                        alert('Ошибка сети');
                    }
                });
            });
        });
    </script>



</body>

</html>
