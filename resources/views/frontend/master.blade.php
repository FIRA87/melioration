<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Простой Шаблон Tailwind</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

<header class="bg-white shadow-md">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex-shrink-0">
                <a href="#" class="text-2xl font-bold text-indigo-600">Мой Сайт</a>
            </div>

            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="/" class="text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">Главная</a>

                </div>
            </div>
        </div>
    </nav>
</header>
<main class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="text-center bg-white p-10 rounded-lg shadow-xl">
        <h1 class="text-5xl font-extrabold text-gray-900 sm:text-6xl">
            Добро пожаловать на наш сайт!
        </h1>
        <p class="mt-6 text-xl text-gray-500 max-w-3xl mx-auto">
            Это простой, но адаптивный шаблон, созданный с использованием утилит **Tailwind CSS**.
        </p>
        <div class="mt-10 flex justify-center">
            <a href="#" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 shadow-lg transform transition duration-150 ease-in-out hover:scale-105">
                Начать
            </a>
            <a href="#" class="ml-4 inline-flex items-center justify-center px-8 py-3 border border-gray-300 text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-gray-50 shadow-lg transform transition duration-150 ease-in-out hover:scale-105">
                Узнать больше
            </a>
        </div>
    </div>
</main>

<footer class="bg-gray-800 mt-12">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <p class="text-center text-gray-400 text-sm">
            &copy; 2025 Мой Сайт. Все права защищены. Создано с Tailwind CSS.
        </p>
    </div>
</footer>

</body>
</html>
