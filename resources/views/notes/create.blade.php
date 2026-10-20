<x-layout title="Нова нотатка" active="3">
    <div class="card bg-base-100 shadow-sm max-w-2xl">
        <div class="card-body">
            <h1 class="card-title text-2xl">Нова нотатка</h1>

            <form method="POST" action="{{ route('notes.store') }}" class="space-y-2">
                @csrf

                @include('notes.form')

                <div class="flex gap-2 pt-2">
                    <button type="submit" class="btn btn-primary">Зберегти</button>
                    <a href="{{ route('notes.index') }}" class="btn btn-ghost">Скасувати</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
