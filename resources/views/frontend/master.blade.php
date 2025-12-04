<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>
      @hasSection('title')
        @yield('title')
    @else
        @if(session('lang') == 'ru') 
            {!! $siteSettings->title_ru !!}
        @elseif(session('lang') == 'en')
            {!! $siteSettings->title_en !!}
        @else
            {!! $siteSettings->title_tj !!}
        @endif
    @endif
  </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
  <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

</head>
<body>

  @include('frontend.inc.header')

 @yield('content')


<!-- Footer -->
  @include('frontend.inc.footer')





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if(Session::has('message'))
    let type = "{{ Session::get('alert-type','info') }}"
    switch(type){
        case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

        case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

        case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

        case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
    }
    @endif

</script>



<script>
  document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('heroSlider');
    const slides = slider.querySelectorAll('.hero-bg');
    
    if (slides.length <= 1) return; // Если слайд один, не переключаем
    
    let currentSlide = 0;
    
    function nextSlide() {
      slides[currentSlide].classList.remove('active');
      currentSlide = (currentSlide + 1) % slides.length;
      slides[currentSlide].classList.add('active');
    }
    
    // Автоматическая смена каждые 5 секунд
    setInterval(nextSlide, 5000);
  });


  // Ленивая загрузка видео при открытии модального окна
  document.addEventListener('DOMContentLoaded', function() {
      // Находим все модальные окна с видео
      const videoModals = document.querySelectorAll('[id^="videoModal"]');
      
      videoModals.forEach(modal => {
          modal.addEventListener('show.bs.modal', function() {
              const iframe = this.querySelector('.video-iframe');
              const src = iframe.getAttribute('data-src');
              if (src && !iframe.getAttribute('src')) {
                  iframe.setAttribute('src', src);
              }
          });
          
          // Останавливаем видео при закрытии модального окна
          modal.addEventListener('hide.bs.modal', function() {
              const iframe = this.querySelector('.video-iframe');
              iframe.setAttribute('src', '');
          });
      });
  });




  document.addEventListener('DOMContentLoaded', function() {
      @if(isset($survey) && $survey)
      const surveyId = {{ $survey->id }};
      const voteUrl = "{{ url('survey') }}/" + surveyId + "/vote";
      
      console.log('Survey initialized. Vote URL:', voteUrl);
      
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
                  console.log('Sending vote:', {
                      url: voteUrl,
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
                  
                  if (!res.ok || !data.success) {
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
                      const totalVotes = data.total || 0;
                      
                      data.counts.forEach(c => {
                          const percentage = totalVotes > 0 ? Math.round((c.votes / totalVotes) * 100) : 0;
                          statsHtml += `
                              <div class="stat-item mb-3">
                                  <div class="d-flex justify-content-between mb-1">
                                      <span class="stat-label">${c.option_text || 'Вариант'}</span>
                                      <span class="stat-value">${c.votes} ${c.votes === 1 ? 'голос' : 'голосов'} (${percentage}%)</span>
                                  </div>
                                  <div class="progress" style="height: 25px; border-radius: 10px;">
                                      <div class="progress-bar bg-success" role="progressbar" 
                                           style="width: ${percentage}%; transition: width 1s ease;"
                                           aria-valuenow="${percentage}" aria-valuemin="0" aria-valuemax="100">
                                           ${percentage}%
                                      </div>
                                  </div>
                              </div>
                          `;
                      });
                      
                      statsHtml += '</div>';
                      statsHtml += `<p class="text-muted mt-3 text-center"><strong>Всего проголосовало: ${totalVotes}</strong></p>`;
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
      @endif
  });


  // Закрытие мобильного меню при клике на ссылку
  document.addEventListener('DOMContentLoaded', function() {
      const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
      const navbarCollapse = document.querySelector('.navbar-collapse');
      
      navLinks.forEach(link => {
          link.addEventListener('click', function() {
              if (window.innerWidth < 992 && navbarCollapse.classList.contains('show')) {
                  const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                  bsCollapse.hide();
              }
          });
      });
  });
</script>
</body>
</html>
