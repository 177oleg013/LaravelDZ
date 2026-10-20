<x-layout title="Редагування нотатки" active="3">
    <div class="card bg-base-100 shadow-sm max-w-2xl">
        <div class="card-body">
            <h1 class="card-title text-2xl">Редагування нотатки</h1>

            <form method="POST" action="{{ route('notes.update', $note) }}" class="space-y-2">
                @csrf
                @method('PATCH')

                @include('notes.form', ['note' => $note])

                <div class="flex gap-2 pt-2">
                    <button type="submit" class="btn btn-primary">Оновити</button>
                    <a href="{{ route('notes.show', $note) }}" class="btn btn-ghost">Скасувати</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
