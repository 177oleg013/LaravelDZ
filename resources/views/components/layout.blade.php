@props(['title' => null, 'active' => null])

@php
    $tasks = \App\Http\Controllers\TaskController::TITLES;
@endphp

<!DOCTYPE html>
<html lang="uk" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ? $title.' - ' : '' }}Notes App</title>
    @vite(['resources/scss/reset.scss', 'resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-base-200 text-base-content">
    <div class="navbar bg-base-100 shadow-sm px-4">
        <div class="flex-1 gap-2">
            <a href="{{ route('home') }}" class="btn btn-ghost text-xl font-bold">Notes App</a>
            <ul class="menu menu-horizontal hidden md:flex">
                <li><a href="{{ route('home') }}" @class(['menu-active' => request()->routeIs('home')])>Головна</a></li>
                <li><a href="{{ route('about') }}" @class(['menu-active' => request()->routeIs('about')])>Про проєкт</a></li>
                @auth
                    <li><a href="{{ route('notes.index') }}" @class(['menu-active' => request()->routeIs('notes.*')])>Мої нотатки</a></li>
                    @can('view-admin')
                        <li><a href="{{ route('admin') }}" @class(['menu-active' => request()->routeIs('admin')])>Адмін</a></li>
                    @endcan
                @endauth
            </ul>
        </div>
        <div class="flex-none flex items-center gap-2">
            <select class="select select-sm w-32" data-theme-select aria-label="Тема">
                <option value="light">light</option>
                <option value="dark">dark</option>
                <option value="cupcake">cupcake</option>
                <option value="emerald">emerald</option>
                <option value="corporate">corporate</option>
                <option value="retro">retro</option>
                <option value="synthwave">synthwave</option>
                <option value="valentine">valentine</option>
                <option value="forest">forest</option>
                <option value="nord">nord</option>
                <option value="dracula">dracula</option>
                <option value="business">business</option>
            </select>
            @guest
                <a href="{{ route('login') }}" class="btn btn-sm btn-ghost">Вхід</a>
                <a href="{{ route('register') }}" class="btn btn-sm btn-primary">Реєстрація</a>
            @endguest
            @auth
                <span class="hidden sm:inline text-sm opacity-70">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline">Вийти</button>
                </form>
            @endauth
        </div>
    </div>

    <div class="bg-base-100 border-b border-base-300 overflow-x-auto">
        <div role="tablist" class="tabs tabs-border max-w-6xl mx-auto px-4 flex-nowrap">
            @foreach ($tasks as $number => $taskTitle)
                <a role="tab" href="{{ route('tasks.show', $number) }}" title="{{ $taskTitle }}"
                   @class(['tab whitespace-nowrap', 'tab-active' => (int) $active === $number])>Завдання {{ $number }}</a>
            @endforeach
        </div>
    </div>

    <main class="max-w-6xl mx-auto p-4 md:p-8 space-y-6">
        @if (session('success'))
            <div role="alert" class="alert alert-success">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div role="alert" class="alert alert-error">
                <span>{{ session('error') }}</span>
            </div>
        @endif

        {{ $slot }}
    </main>

    <footer class="footer footer-center p-6 text-base-content/60">
        <p>Notes App - навчальний проєкт з дисципліни "Розробка на Laravel"</p>
    </footer>
</body>
</html>
