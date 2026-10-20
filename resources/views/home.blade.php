<x-layout title="Головна">
    <div class="hero bg-base-100 rounded-box shadow-sm">
        <div class="hero-content text-center py-12">
            <div class="max-w-2xl">
                <h1 class="text-5xl font-bold">Notes App</h1>
                <p class="py-6 opacity-80">
                    Застосунок для ведення нотаток і задач на Laravel. Кожна вкладка "Завдання" відповідає окремій темі курсу та містить реалізацію всіх вправ цієї теми.
                </p>
                @guest
                    <div class="flex justify-center gap-3">
                        <a href="{{ route('register') }}" class="btn btn-primary">Створити акаунт</a>
                        <a href="{{ route('login') }}" class="btn btn-outline">Увійти</a>
                    </div>
                @endguest
                @auth
                    <a href="{{ route('notes.index') }}" class="btn btn-primary">Перейти до нотаток</a>
                @endauth
            </div>
        </div>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach (\App\Http\Controllers\TaskController::TITLES as $number => $taskTitle)
            <a href="{{ route('tasks.show', $number) }}" class="card bg-base-100 shadow-sm hover:shadow-md transition">
                <div class="card-body">
                    <div class="badge badge-outline">Завдання {{ $number }}</div>
                    <h2 class="card-title">{{ $taskTitle }}</h2>
                </div>
            </a>
        @endforeach
    </div>
</x-layout>
