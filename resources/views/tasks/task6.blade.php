<x-layout :title="'Завдання '.$number" :active="$number">
    <x-task-header :number="$number" :title="$title">
        Gate для адміністративної сторінки, NotePolicy для нотаток, приховування посилань через @@can та перевірка доступу в контролері через Gate::authorize().
    </x-task-header>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title">Gate view-admin</h2>
                <p>Gate визначено в AppServiceProvider. Маршрут /admin захищено через ->can('view-admin'). Для користувача без прав повертається Response::denyAsNotFound(), тобто 404.</p>
                @auth
                    <div class="flex items-center gap-2">
                        <span>Ваша роль:</span>
                        @can('view-admin')
                            <span class="badge badge-primary">адміністратор</span>
                        @else
                            <span class="badge badge-ghost">користувач</span>
                        @endcan
                    </div>
                @endauth
                <div class="card-actions justify-end">
                    <a href="{{ url('/admin') }}" class="btn btn-primary btn-sm">Відкрити /admin</a>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title">NotePolicy</h2>
                <div class="overflow-x-auto">
                    <table class="table table-sm">
                        <thead>
                            <tr><th>Метод</th><th>Правило</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>viewAny</td><td>будь-який авторизований користувач</td></tr>
                            <tr><td>view</td><td>лише власник, інакше 404</td></tr>
                            <tr><td>create</td><td>будь-який авторизований користувач</td></tr>
                            <tr><td>update</td><td>лише власник, інакше 404</td></tr>
                            <tr><td>delete</td><td>лише власник, інакше 404</td></tr>
                        </tbody>
                    </table>
                </div>
                <p class="text-sm opacity-70">Кнопки редагування й видалення показуються лише при успішній перевірці @@can.</p>
            </div>
        </div>
    </div>

    <div class="card bg-base-100 shadow-sm">
        <div class="card-body">
            <h2 class="card-title">Перевірка чужої нотатки</h2>
            <p>Увійдіть як admin@example.com, відкрийте /admin і перейдіть за посиланням на нотатку іншого користувача. Policy поверне сторінку 404, хоча нотатка існує в базі даних.</p>
        </div>
    </div>
</x-layout>
