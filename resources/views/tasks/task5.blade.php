<x-layout :title="'Завдання '.$number" :active="$number">
    <x-task-header :number="$number" :title="$title">
        Власна реєстрація та вхід без стартових наборів, захист маршрутів middleware auth і guest, а також зв'язок кожної нотатки з її власником.
    </x-task-header>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title">Вправа 1 - реєстрація</h2>
                <p>Контролер Auth\RegisteredUserController показує форму, валідує дані, зберігає користувача з хешованим паролем, виконує вхід і переадресовує на сторінку нотаток.</p>
                <div class="card-actions justify-end">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Реєстрація</a>
                    @endguest
                    @auth
                        <span class="badge badge-ghost">Посилання приховано, бо ви вже увійшли</span>
                    @endauth
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title">Вправа 2 - вхід, вихід, middleware</h2>
                <p>Auth\SessionsController відповідає за вхід і вихід. Маршрути нотаток доступні лише через middleware auth, а сторінки входу й реєстрації лише гостям. Після входу користувач повертається на сторінку, яку відкривав.</p>
                <div class="card-actions justify-end">
                    @guest
                        <a href="{{ route('notes.create') }}" class="btn btn-outline btn-sm">Перевірити /notes/create</a>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Вхід</a>
                    @endguest
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline btn-sm">Вийти</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title">Вправа 3 - власники нотаток</h2>
                <p>У таблиці notes є поле user_id. User має зв'язок hasMany notes, а Note має belongsTo user. Контролер отримує список через $request->user()->notes().</p>
                @auth
                    <div class="stats bg-base-200">
                        <div class="stat">
                            <div class="stat-title">Ваших нотаток</div>
                            <div class="stat-value">{{ auth()->user()->notes()->count() }}</div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <div class="card bg-base-100 shadow-sm">
        <div class="card-body">
            <h2 class="card-title">Перевірка зв'язків у Tinker</h2>
            <div class="mockup-code text-sm">
                <pre data-prefix=">"><code>App\Models\User::first()->notes</code></pre>
                <pre data-prefix=">"><code>App\Models\Note::first()->user</code></pre>
                <pre data-prefix=">"><code>App\Models\Note::where('user_id', 1)->count()</code></pre>
            </div>
        </div>
    </div>
</x-layout>
