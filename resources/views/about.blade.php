<x-layout title="Про проєкт" active="2">
    <div class="card bg-base-100 shadow-sm">
        <div class="card-body space-y-3">
            <h1 class="card-title text-3xl">Про проєкт</h1>
            <p>
                Це статична сторінка, зареєстрована через Route::view. Вона не має власного контролера, а її вміст обгорнуто в спільний компонент макета x-layout, тому навігація, вкладки та підвал однакові на всіх сторінках застосунку.
            </p>
            <p>
                Notes App дозволяє користувачу створювати нотатки зі статусом і терміном виконання, редагувати та видаляти їх, а також працювати з ними через JSON API.
            </p>
            <div class="card-actions">
                <a href="{{ route('tasks.show', 2) }}" class="btn btn-outline btn-sm">Повернутися до завдання 2</a>
            </div>
        </div>
    </div>
</x-layout>
