<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Финансовый квест</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            width: 90%;
            max-width: 800px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .header {
            background: #4caf50;
            color: white;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            margin: -30px -30px 20px;
            font-size: 1.5em;
        }
        .progress-bar {
            width: 100%;
            background: #e0e0e0;
            border-radius: 5px;
            height: 12px;
            margin: 20px 0;
        }
        .progress {
            height: 100%;
            background: #4caf50;
            border-radius: 5px;
            transition: width 0.3s ease;
        }
        .timer {
            font-size: 1.1em;
            color: #d32f2f;
            margin-bottom: 15px;
            font-weight: bold;
        }
        .question-block {
            margin-bottom: 20px;
            opacity: 0;
            transform: translateY(20px);
            animation: slideIn 0.5s forwards;
        }
        .question {
            font-size: 1.3em;
            margin-bottom: 15px;
            color: #1e3c72;
        }
        .options {
            display: grid;
            gap: 10px;
        }
        .option {
            padding: 12px;
            border: 2px solid #2a5298;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f5f6f5;
            font-size: 1em;
        }
        .option:hover {
            background: #e3f2fd;
            transform: scale(1.02);
        }
        .option.selected {
            background: #bbdefb;
            border-color: #1976d2;
        }
        button {
            padding: 12px 30px;
            background: #4caf50;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            margin: 10px;
            transition: background 0.3s;
        }
        button:disabled {
            background: #bdbdbd;
            cursor: not-allowed;
        }
        button:hover:not(:disabled) {
            background: #388e3c;
        }
        .result {
            margin-top: 20px;
            animation: slideIn 0.5s ease;
        }
        .result img {
            max-width: 200px;
            margin: 10px 0;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .hidden {
            display: none;
        }
        .money-icon {
            position: absolute;
            font-size: 50px;
            opacity: 0.1;
            color: #4caf50;
        }
        .money-icon.top-left {
            top: 20px;
            left: 20px;
            transform: rotate(-30deg);
        }
        .money-icon.bottom-right {
            bottom: 20px;
            right: 20px;
            transform: rotate(30deg);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Финансовый квест</div>
        <span class="money-icon top-left">💰</span>
        <span class="money-icon bottom-right">💵</span>
        <div class="progress-bar">
            <div class="progress" id="progress"></div>
        </div>
        <div class="timer" id="timer">Осталось: 120 секунд</div>
        <div id="questions"></div>
        <button id="submitBtn" disabled>Отправить ответы</button>
        <div class="result hidden" id="result"></div>
        <div style="margin: 10px 0">
            <a href="https://fingram.tj/" style="background-color: red; color: #fff; padding: 10px; text-decoration: none;"> Вернуться на сайт</a>
        </div>
    </div>

    <audio id="correctSound" src="https://directory.audio/ru/zvukovye-effekty/interface-ui/15986-uspekh-kvest-zavershen-zvuk-rpg"></audio>
    <audio id="wrongSound" src="https://www.soundjay.com/sounds/notification-02.mp3"></audio>

    <script>
        const questions = [
            {
                question: "Что такое семейный бюджет?",
                options: [
                    "Список покупок на месяц",
                    "План управления доходами и расходами семьи",
                    "Документ с расходами семьи",
                    "План по инвестированию",
                    "Не знаю"
                ],
                correct: 1
            },
            {
                question: "Что означает 'доход'?",
                options: [
                    "Деньги, которые вы тратите",
                    "Деньги, отложенные на сберегательный счёт",
                    "Подаренные деньги от друзей",
                    "Деньги, которые вы зарабатываете или получаете",
                    "Не знаю"
                ],
                correct: 3
            },
            {
                question: "Зачем нужно откладывать деньги?",
                options: [
                    "Чтобы не тратить всё сразу",
                    "Чтобы быть готовым к непредвиденным ситуациям и целям",
                    "Чтобы хвастаться накопленным",
                    "Чтобы деньги не лежали в кошельке",
                    "Не знаю"
                ],
                correct: 1
            },
            {
                question: "Что такое кредит?",
                options: [
                    "Деньги, которые вам дарят",
                    "Деньги, потраченные на развлечения",
                    "Деньги, полученные за работу",
                    "Деньги взаймы, подлежащие возврату с процентами",
                    "Не знаю"
                ],
                correct: 3
            },
            {
                question: "Как избежать ненужных трат?",
                options: [
                    "Покупки по настроению",
                    "Регулярный просмотр рекламы",
                    "Игнорировать акции и скидки",
                    "Ведение списка покупок",
                    "Не знаю"
                ],
                correct: 3
            },
            {
                question: "Что такое банковская карта?",
                options: [
                    "Документ, удостоверяющий личность",
                    "Абонемент в магазин",
                    "Средство доступа к деньгам на счёте",
                    "Карта маршрутов",
                    "Не знаю"
                ],
                correct: 2
            },
            {
                question: "Почему важно читать договор?",
                options: [
                    "Чтобы понимать свои права и риски",
                    "Чтобы знать, где подписать",
                    "Чтобы не тратить время юриста",
                    "Потому что это интересно",
                    "Не знаю"
                ],
                correct: 0
            },
            {
                question: "Где безопаснее хранить деньги?",
                options: [
                    "Под подушкой",
                    "В кошельке",
                    "На счёте в банке",
                    "В тайнике в огороде",
                    "Не знаю"
                ],
                correct: 2
            },
            {
                question: "Если вам предлагают приз за перевод денег — это:",
                options: [
                    "Лотерея",
                    "Благотворительная акция",
                    "Маркетинговый ход",
                    "Мошенничество",
                    "Не знаю"
                ],
                correct: 3
            },
            {
                question: "Какая функция у денег?",
                options: [
                    "Хранение эмоций",
                    "Средство обмена и измерения стоимости",
                    "Мера роста экономики",
                    "Подарочный символ",
                    "Не знаю"
                ],
                correct: 1
            }
        ];

        let score = 0;
        let timeLeft = 120;
        let timer;
        let selectedOptions = new Array(questions.length).fill(null);

        const questionsEl = document.getElementById('questions');
        const submitBtn = document.getElementById('submitBtn');
        const progressEl = document.getElementById('progress');
        const timerEl = document.getElementById('timer');
        const resultEl = document.getElementById('result');
        const correctSound = document.getElementById('correctSound');
        const wrongSound = document.getElementById('wrongSound');

        function startTimer() {
            timer = setInterval(() => {
                timeLeft--;
                timerEl.textContent = `Осталось: ${timeLeft} секунд`;
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    showResult();
                }
            }, 1000);
        }

        function loadQuestions() {
            questions.forEach((q, index) => {
                const questionBlock = document.createElement('div');
                questionBlock.className = 'question-block';
                questionBlock.innerHTML = `
                    <div class="question">${index + 1}. ${q.question}</div>
                    <div class="options" id="options-${index}"></div>
                `;
                questionsEl.appendChild(questionBlock);
                const optionsEl = document.getElementById(`options-${index}`);
                q.options.forEach((option, optIndex) => {
                    const div = document.createElement('div');
                    div.className = 'option';
                    div.textContent = option;
                    div.onclick = () => selectOption(index, optIndex);
                    optionsEl.appendChild(div);
                });
            });
            updateProgress();
        }

        function selectOption(questionIndex, optionIndex) {
            selectedOptions[questionIndex] = optionIndex;
            const options = document.getElementById(`options-${questionIndex}`).children;
            Array.from(options).forEach((opt, i) => {
                opt.classList.toggle('selected', i === optionIndex);
            });
            updateSubmitButton();
            updateProgress();
        }

        function updateSubmitButton() {
            // Enable submit button if at least one question is answered
            submitBtn.disabled = !selectedOptions.some(opt => opt !== null);
        }

        function updateProgress() {
            const answered = selectedOptions.filter(opt => opt !== null).length;
            progressEl.style.width = `${(answered / questions.length) * 100}%`;
        }

        function checkAnswers() {
            selectedOptions.forEach((selected, index) => {
                if (selected === questions[index].correct) {
                    score++;
                    correctSound.play();
                } else if (selected !== null && selected !== questions[index].options.length - 1) {
                    wrongSound.play();
                }
            });
        }

        function showResult() {
            clearInterval(timer);
            checkAnswers();
            questionsEl.classList.add('hidden');
            submitBtn.classList.add('hidden');
            timerEl.classList.add('hidden');
            let level, recommendation;
            if (score <= 3) {
                level = '📉 Низкий уровень';
                recommendation = 'Рекомендуем начать с основ: научитесь вести бюджет, различать доходы и расходы. Посетите разделы по базовой финансовой грамотности.';
            } else if (score <= 7) {
                level = '📘 Средний уровень';
                recommendation = 'Вы хорошо справились! Рекомендуем изучить темы кредитов, банковских продуктов и защиты прав потребителей.';
            } else {
                level = '✅ Высокий уровень';
                recommendation = 'Отличный результат! Подумайте об инвестициях, страховании и поделитесь знаниями с окружающими.';
            }
            resultEl.innerHTML = `
                <h2>Ваш результат: ${score} из 10</h2>
                <p><strong>${level}</strong></p>
                <p>${recommendation}</p>
                ${score >= 8 ? '<img src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExYzI2YzU3ZTI1N2Q0MGU5ZGM3NDM2YzY0YzNhYzVhY2E0Y2I4YzI4MCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/l0Iyl55zTggnP3P7a/giphy.gif" alt="Финансовый успех">' : ''}
                <button onclick="restart()">Пройти снова</button>
                <button onclick="shareResult()">Поделиться</button>
            `;
            resultEl.classList.remove('hidden');
        }

        function restart() {
            score = 0;
            timeLeft = 120;
            selectedOptions = new Array(questions.length).fill(null);
            resultEl.classList.add('hidden');
            questionsEl.classList.remove('hidden');
            submitBtn.classList.remove('hidden');
            timerEl.classList.remove('hidden');
            questionsEl.innerHTML = '';
            loadQuestions();
            startTimer();
        }

        function shareResult() {
            const text = `Я прошел Финансовый квест и набрал ${score} из 10! Попробуй и ты!`;
            navigator.clipboard.writeText(text);
            alert('Результат скопирован в буфер обмена!');
        }

        submitBtn.onclick = showResult;

        loadQuestions();
        startTimer();
    </script>
</body>
</html>