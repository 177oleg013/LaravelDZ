<x-layout title="Мої нотатки" active="3">
    <div class="flex flex-wrap items-center justify-between gap-3">
        <h1 class="text-3xl font-bold">Мої нотатки</h1>
        @can('create', \App\Models\Note::class)
            <a href="{{ route('notes.create') }}" class="btn btn-primary">Нова нотатка</a>
        @endcan
    </div>

    @if ($notes->isEmpty())
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body items-center text-center">
                <p class="opacity-70">У вас ще немає нотаток.</p>
                <a href="{{ route('notes.create') }}" class="btn btn-outline btn-sm">Створити першу</a>
            </div>
        </div>
    @else
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($notes as $note)
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="badge {{ $note->statusBadge() }}">{{ $note->statusLabel() }}</span>
                            @if ($note->due_date)
                                <span @class(['badge badge-outline', 'badge-error' => $note->isOverdue()])>до {{ $note->due_date->format('d.m.Y') }}</span>
                            @endif
                        </div>
                        <h2 class="card-title">{{ $note->title }}</h2>
                        <p class="opacity-80">{{ \Illuminate\Support\Str::limit($note->body, 100) }}</p>
                        <div class="card-actions justify-end">
                            @can('view', $note)
                                <a href="{{ route('notes.show', $note) }}" class="btn btn-sm btn-ghost">Відкрити</a>
                            @endcan
                            @can('update', $note)
                                <a href="{{ route('notes.edit', $note) }}" class="btn btn-sm btn-outline">Редагувати</a>
                            @endcan
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-layout>
