<x-layout :title="'Завдання '.$number" :active="$number">
    <x-task-header :number="$number" :title="$title">
        Tailwind CSS та daisyUI підключено через Vite. Нижче наведено приклади компонентів button, card, navbar, input, alert і modal. Тему можна змінити списком нижче або в правому верхньому куті, і всі компоненти одразу змінюють вигляд.
    </x-task-header>

    <div class="card bg-base-100 shadow-sm">
        <div class="card-body flex-row flex-wrap items-center gap-3">
            <span class="font-semibold">Тема:</span>
            <select class="select select-bordered w-48" data-theme-select aria-label="Тема сторінки">
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
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title">Button</h2>
                <div class="flex flex-wrap gap-2">
                    <button class="btn">Default</button>
                    <button class="btn btn-primary">Primary</button>
                    <button class="btn btn-secondary">Secondary</button>
                    <button class="btn btn-accent">Accent</button>
                    <button class="btn btn-outline">Outline</button>
                    <button class="btn btn-ghost">Ghost</button>
                    <button class="btn btn-link">Link</button>
                    <button class="btn btn-sm btn-success">Small</button>
                    <button class="btn btn-lg btn-error">Large</button>
                    <button class="btn" disabled>Disabled</button>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title">Card</h2>
                <div class="card bg-base-200 card-border">
                    <div class="card-body">
                        <h3 class="card-title">Підготувати звіт</h3>
                        <p>Приклад картки нотатки зі статусом і кнопками дій.</p>
                        <div class="card-actions justify-end">
                            <span class="badge badge-warning">В роботі</span>
                            <button class="btn btn-primary btn-sm">Відкрити</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm lg:col-span-2">
            <div class="card-body">
                <h2 class="card-title">Navbar</h2>
                <div class="navbar bg-base-200 rounded-box">
                    <div class="flex-1">
                        <a class="btn btn-ghost text-lg">Notes</a>
                    </div>
                    <div class="flex-none">
                        <ul class="menu menu-horizontal px-1">
                            <li><a>Нотатки</a></li>
                            <li><a>Профіль</a></li>
                            <li><a class="btn btn-primary btn-sm text-primary-content">Вийти</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title">Input</h2>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Звичайне поле</legend>
                    <input type="text" class="input w-full" placeholder="Назва нотатки">
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Основний колір</legend>
                    <input type="text" class="input input-primary w-full" placeholder="input-primary">
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Помилка валідації</legend>
                    <input type="text" class="input input-error w-full" value="ab">
                    <p class="text-error text-sm">Назва має містити щонайменше 3 символи</p>
                </fieldset>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm">
            <div class="card-body space-y-2">
                <h2 class="card-title">Alert</h2>
                <div role="alert" class="alert alert-info"><span>Нову версію застосунку встановлено.</span></div>
                <div role="alert" class="alert alert-success"><span>Нотатку збережено.</span></div>
                <div role="alert" class="alert alert-warning"><span>Термін виконання спливає завтра.</span></div>
                <div role="alert" class="alert alert-error"><span>Не вдалося видалити нотатку.</span></div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm lg:col-span-2">
            <div class="card-body">
                <h2 class="card-title">Modal</h2>
                <p>Модальне вікно побудоване на елементі dialog. Цей самий компонент використовується для підтвердження видалення нотатки.</p>
                <div>
                    <button class="btn btn-primary" onclick="document.getElementById('demo-modal').showModal()">Відкрити модальне вікно</button>
                </div>
                <dialog id="demo-modal" class="modal">
                    <div class="modal-box">
                        <h3 class="text-lg font-bold">Модальне вікно daisyUI</h3>
                        <p class="py-4">Натисніть кнопку або клікніть поза вікном, щоб закрити його.</p>
                        <div class="modal-action">
                            <form method="dialog">
                                <button class="btn">Закрити</button>
                            </form>
                        </div>
                    </div>
                    <form method="dialog" class="modal-backdrop">
                        <button>Закрити</button>
                    </form>
                </dialog>
            </div>
        </div>
    </div>
</x-layout>
