@extends('frontend.master')
@section('content')



<!-- Опросник -->
<section class="survey-section">
    <div class="container">
        <div class="survey-card">
            <h2 class="survey-title">{{ $survey->title_ru }}</h2>
            @if ($survey->description_ru)
                <p class="survey-description">{{ $survey->description_ru }}</p>
            @endif

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
                            <button type="submit" class="vote-btn">Отправить</button>
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
                            <button type="submit" class="vote-btn">Голосовать</button>
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
        <h2 class="contact-title">ОБРАЩЕНИЯ ГРАЖДАН И ОБРАТНАЯ СВЯЗЬ</h2>
        
        <div class="row">
            <div class="col-md-10 mx-auto">
                <form action="{{ route('contact_form_submit') }}" method="POST" class="contact-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" 
                                   name="name" 
                                   class="contact-input" 
                                   placeholder="Ф.И.О"
                                   required>
                        </div>
                        <div class="col-md-6">
                            <input type="tel" 
                                   name="phone" 
                                   class="contact-input" 
                                   placeholder="Телефон"
                                   required>
                        </div>
                        <div class="col-md-12">
                            <input type="email" 
                                   name="email" 
                                   class="contact-input" 
                                   placeholder="Email"
                                   required>
                        </div>
                        <div class="col-md-12">
                            <textarea name="message" 
                                      class="contact-textarea" 
                                      placeholder="Тема"
                                      required></textarea>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="contact-submit">Отправить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const surveyId = {{ $survey->id }};
    const voteUrl = "{{ url('survey') }}/" + surveyId + "/vote";
    
    document.querySelectorAll('.vote-form').forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const questionId = this.dataset.questionId;
            const questionCard = this.closest('.question-card');
            const type = this.querySelector('input[type="radio"], input[type="checkbox"]') ? 'choice' : 'text';
            let optionId = null;
            let textAnswer = null;

            if (type === 'choice') {
                const checked = this.querySelector('input[name="option"]:checked');
                if (!checked) {
                    alert('Пожалуйста, выберите вариант ответа');
                    return;
                }
                optionId = checked.value;
            } else {
                textAnswer = this.querySelector('textarea[name="text_answer"]').value.trim();
                if (!textAnswer) {
                    alert('Пожалуйста, введите ваш ответ');
                    return;
                }
            }

            const token = document.querySelector('meta[name="csrf-token"]').content;
            const button = this.querySelector('button[type="submit"]');
            const originalButtonText = button.textContent;
            
            button.disabled = true;
            button.textContent = 'Отправка...';

            try {
                console.log('Sending vote to:', voteUrl);
                console.log('Data:', {
                    question_id: questionId,
                    option_id: optionId,
                    text_answer: textAnswer
                });

                const res = await fetch(voteUrl, {
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
                
                console.log('Response status:', res.status);
                const data = await res.json();
                console.log('Response data:', data);
                
                if (!res.ok) {
                    alert(data.message || 'Произошла ошибка при отправке голоса');
                    button.disabled = false;
                    button.textContent = originalButtonText;
                    return;
                }

                // Скрываем форму
                this.style.display = 'none';

                // Создаем блок статистики
                let statsHtml = '<div class="vote-statistics">';
                statsHtml += '<h6 class="text-success mb-3">✓ Спасибо за участие!</h6>';
                
                if (data.counts && data.counts.length > 0) {
                    statsHtml += '<div class="stats-bars">';
                    const totalVotes = data.total || data.counts.reduce((sum, c) => sum + parseInt(c.votes), 0);
                    
                    data.counts.forEach(c => {
                        const percentage = totalVotes > 0 ? Math.round((c.votes / totalVotes) * 100) : 0;
                        statsHtml += `
                            <div class="stat-item mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="stat-label">${c.option_text || 'Вариант'}</span>
                                    <span class="stat-value">${c.votes} голосов (${percentage}%)</span>
                                </div>
                                <div class="progress" style="height: 25px; border-radius: 10px;">
                                    <div class="progress-bar bg-success" role="progressbar" 
                                         style="width: ${percentage}%; transition: width 1s ease;"
                                         aria-valuenow="${percentage}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    
                    statsHtml += '</div>';
                    statsHtml += `<p class="text-muted mt-3">Всего проголосовало: ${totalVotes}</p>`;
                } else {
                    statsHtml += '<p class="text-success">Ваш ответ принят!</p>';
                }
                
                statsHtml += '</div>';

                // Добавляем статистику в карточку вопроса
                questionCard.insertAdjacentHTML('beforeend', statsHtml);

                // Через 15 секунд скрываем статистику и показываем форму снова
                setTimeout(() => {
                    const statsBlock = questionCard.querySelector('.vote-statistics');
                    if (statsBlock) {
                        statsBlock.style.transition = 'opacity 0.5s ease';
                        statsBlock.style.opacity = '0';
                        
                        setTimeout(() => {
                            statsBlock.remove();
                            // Показываем форму снова и сбрасываем её
                            this.style.display = 'block';
                            this.reset();
                            button.disabled = false;
                            button.textContent = originalButtonText;
                            // Снимаем disabled со всех полей
                            this.querySelectorAll('input, textarea').forEach(el => el.disabled = false);
                        }, 500);
                    }
                }, 15000); // 15 секунд

            } catch (err) {
                console.error('Error:', err);
                alert('Ошибка сети. Пожалуйста, попробуйте позже.');
                button.disabled = false;
                button.textContent = originalButtonText;
            }
        });
    });
});

</script>

@endsection