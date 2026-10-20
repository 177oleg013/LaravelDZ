<x-layout :title="'Завдання '.$number" :active="$number">
    <x-task-header :number="$number" :title="$title">
        Сутність Note з міграцією та Eloquent-моделлю, сім ресурсних дій контролера, Blade-сторінки в папці resources/views/notes, поля статусу й терміну з валідацією через Form Request, а також JSON API.
    </x-task-header>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title">Вправи 1-2 - CRUD та валідація</h2>
                <div class="overflow-x-auto">
                    <table class="table table-sm">
                        <thead>
                            <tr><th>Дія</th><th>Метод</th><th>Адреса</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>index</td><td>GET</td><td>/notes</td></tr>
                            <tr><td>create</td><td>GET</td><td>/notes/create</td></tr>
                            <tr><td>store</td><td>POST</td><td>/notes</td></tr>
                            <tr><td>show</td><td>GET</td><td>/notes/{note}</td></tr>
                            <tr><td>edit</td><td>GET</td><td>/notes/{note}/edit</td></tr>
                            <tr><td>update</td><td>PATCH</td><td>/notes/{note}</td></tr>
                            <tr><td>destroy</td><td>DELETE</td><td>/notes/{note}</td></tr>
                        </tbody>
                    </table>
                </div>
                <p class="text-sm opacity-70">Правила та повідомлення про помилки винесено в StoreNoteRequest і UpdateNoteRequest.</p>
                <div class="card-actions justify-end">
                    @auth
                        <a href="{{ route('notes.index') }}" class="btn btn-primary btn-sm">Мої нотатки</a>
                        <a href="{{ route('notes.create') }}" class="btn btn-outline btn-sm">Нова нотатка</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Увійдіть, щоб працювати з нотатками</a>
                    @endauth
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title">Вправа 3 - JSON API</h2>
                <div class="overflow-x-auto">
                    <table class="table table-sm">
                        <thead>
                            <tr><th>Метод</th><th>Адреса</th><th>Статус</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>GET</td><td>/api/notes</td><td>200</td></tr>
                            <tr><td>POST</td><td>/api/notes</td><td>201 або 422</td></tr>
                            <tr><td>GET</td><td>/api/notes/{id}</td><td>200 або 404</td></tr>
                            <tr><td>PATCH</td><td>/api/notes/{id}</td><td>200</td></tr>
                            <tr><td>DELETE</td><td>/api/notes/{id}</td><td>204</td></tr>
                        </tbody>
                    </table>
                </div>

                @auth
                    <form method="POST" action="{{ route('tokens.store') }}">
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-sm">Згенерувати API-токен</button>
                    </form>
                    @if (session('token'))
                        <div role="alert" class="alert alert-info flex-col items-start">
                            <span>Токен показується лише один раз. Передайте його в заголовку Authorization: Bearer</span>
                            <code class="break-all font-mono text-sm">{{ session('token') }}</code>
                        </div>
                    @endif
                @else
                    <p class="text-sm opacity-70">Для отримання токена потрібно увійти.</p>
                @endauth

                <div class="mockup-code text-xs mt-2">
                    <pre data-prefix="1"><code>POST {{ url('/api/notes') }}</code></pre>
                    <pre data-prefix="2"><code>Accept: application/json</code></pre>
                    <pre data-prefix="3"><code>Authorization: Bearer ТОКЕН</code></pre>
                    <pre data-prefix="4"><code>{"title": "Купити молоко", "status": "todo"}</code></pre>
                </div>
            </div>
        </div>
    </div>
</x-layout>
