<x-layout :title="'Завдання '.$number" :active="$number">
    <x-task-header :number="$number" :title="$title">
        Локальне середовище розгорнуто через Laravel Herd, а проєкт створено командою laravel new. Нижче наведено дані, які застосунок отримує від PHP та веб-сервера під час обробки цього запиту.
    </x-task-header>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="card bg-base-100 shadow-sm lg:col-span-2">
            <div class="card-body">
                <h2 class="card-title">Перевірка середовища</h2>
                <div class="overflow-x-auto">
                    <table class="table">
                        <tbody>
                            @foreach ($environment as $label => $value)
                                <tr>
                                    <th class="w-1/3">{{ $label }}</th>
                                    <td class="break-all">{{ $value }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title">Команди</h2>
                <div class="mockup-code text-sm">
                    <pre data-prefix="$"><code>herd --version</code></pre>
                    <pre data-prefix="$"><code>php -v</code></pre>
                    <pre data-prefix="$"><code>laravel new notes-app</code></pre>
                    <pre data-prefix="$"><code>cd notes-app</code></pre>
                    <pre data-prefix="$"><code>npm install</code></pre>
                    <pre data-prefix="$"><code>npm run dev</code></pre>
                </div>
                <div role="alert" class="alert alert-success mt-4">
                    <span>Сторінка відкрилась - отже PHP, веб-сервер і Laravel працюють коректно.</span>
                </div>
            </div>
        </div>
    </div>
</x-layout>
