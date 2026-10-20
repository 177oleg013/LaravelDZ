<x-layout :title="'Завдання '.$number" :active="$number">
    <x-task-header :number="$number" :title="$title">
        Реєстрація нових маршрутів, створення Blade-сторінок у спільному макеті, обробка POST-запиту форми з CSRF-захистом і збереження даних у сесії.
    </x-task-header>

    <div class="grid gap-6 md:grid-cols-2">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title">Вправа 1 - статична сторінка з макетом</h2>
                <p>Маршрут <code class="badge badge-ghost">Route::view('/about', 'about')</code> повертає Blade-сторінку, загорнуту в компонент <code class="badge badge-ghost">&lt;x-layout&gt;</code>. Усі сторінки сайту використовують цей самий макет.</p>
                <div class="card-actions justify-end">
                    <a href="{{ route('about') }}" class="btn btn-primary btn-sm">Відкрити сторінку "Про проєкт"</a>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title">Вправа 2 - форма, CSRF та сесія</h2>
                <p>Форма надсилає POST-запит з токеном <code class="badge badge-ghost">@@csrf</code>. Контролер валідує дані, додає їх у сесію через <code class="badge badge-ghost">session()->push()</code> і передає ім'я на сторінку через flash-дані.</p>
                <div class="card-actions justify-end">
                    <a href="{{ route('feedback.create') }}" class="btn btn-primary btn-sm">Відкрити форму</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card bg-base-100 shadow-sm">
        <div class="card-body">
            <h2 class="card-title">Перевірка CSRF</h2>
            <p>Ця форма навмисно не містить токена, тому Laravel відхиляє запит зі статусом 419 Page Expired.</p>
            <form method="POST" action="{{ route('feedback.store') }}">
                <input type="hidden" name="name" value="Test">
                <input type="hidden" name="message" value="Запит без токена">
                <button type="submit" class="btn btn-warning btn-sm">Надіслати без CSRF</button>
            </form>
        </div>
    </div>
</x-layout>
