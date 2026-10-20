<x-layout :title="'Завдання '.$number" :active="$number">
    <x-task-header :number="$number" :title="$title">
        Скидання стилів на Sass, сповіщення NotePublished через пошту та базу даних, відправка сповіщень у фоні через чергу і автоматичний тест головної сторінки.
    </x-task-header>

    <div class="stats stats-vertical sm:stats-horizontal bg-base-100 shadow-sm w-full">
        <div class="stat">
            <div class="stat-title">Поштовий драйвер</div>
            <div class="stat-value text-2xl">{{ $mailer }}</div>
        </div>
        <div class="stat">
            <div class="stat-title">З'єднання черги</div>
            <div class="stat-value text-2xl">{{ $queue }}</div>
        </div>
        <div class="stat">
            <div class="stat-title">Задач у таблиці jobs</div>
            <div class="stat-value text-2xl">{{ $jobs->count() }}</div>
        </div>
        <div class="stat">
            <div class="stat-title">Невдалих задач</div>
            <div class="stat-value text-2xl">{{ $failedJobs }}</div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title">Вправа 1 - Sass</h2>
                <p>Файл resources/scss/reset.scss компілюється пакетом sass і підключається у vite.config.js та в макеті. Для перевірки без Tailwind використовується режим збірки sass, у якому плагін Tailwind вимкнено.</p>
                <div class="mockup-code text-sm">
                    <pre data-prefix="$"><code>npm install -D sass</code></pre>
                    <pre data-prefix="$"><code>npm run build -- --mode sass</code></pre>
                    <pre data-prefix="$"><code>npm run build</code></pre>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title">Вправа 4 - тести</h2>
                <p>Тест tests/Feature/ExampleTest.php надсилає запит на головну сторінку і перевіряє статус 200 та наявність тексту Notes App.</p>
                <div class="mockup-code text-sm">
                    <pre data-prefix="$"><code>php artisan test</code></pre>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title">Вправа 2 - сповіщення</h2>
                @if (! $hasNotifications)
                    <div role="alert" class="alert alert-warning">
                        <span>Таблиці notifications ще немає. Виконайте php artisan make:notifications-table та php artisan migrate.</span>
                    </div>
                @elseif (! auth()->check())
                    <p class="opacity-70">Увійдіть, щоб побачити свої сповіщення.</p>
                @else
                    @forelse ($notifications as $notification)
                        <div class="border border-base-300 rounded-box p-3">
                            <div class="flex justify-between text-sm opacity-70">
                                <span>NotePublished</span>
                                <span>{{ $notification->created_at->format('d.m.Y H:i:s') }}</span>
                            </div>
                            <p class="font-semibold">{{ $notification->data['title'] ?? 'Без назви' }}</p>
                        </div>
                    @empty
                        <p class="opacity-70">Сповіщень ще немає. Створіть нотатку і запустіть обробник черги.</p>
                    @endforelse
                @endif
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title">Вправа 3 - черга</h2>
                <p>NotePublished реалізує ShouldQueue, тому після створення нотатки в таблиці jobs з'являється задача. Її виконує обробник черги.</p>
                <div class="mockup-code text-sm">
                    <pre data-prefix="$"><code>php artisan queue:work</code></pre>
                </div>
                @forelse ($jobs as $job)
                    <div class="border border-base-300 rounded-box p-3 text-sm">
                        <div class="flex justify-between">
                            <span>#{{ $job->id }} - {{ $job->queue }}</span>
                            <span>спроб {{ $job->attempts }}</span>
                        </div>
                        <p class="opacity-70 break-all">{{ json_decode($job->payload, true)['displayName'] ?? 'Job' }}</p>
                    </div>
                @empty
                    <p class="opacity-70">Черга порожня.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layout>
