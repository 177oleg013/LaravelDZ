<x-layout :title="$note->title" active="3">
    <div class="card bg-base-100 shadow-sm max-w-3xl">
        <div class="card-body space-y-3">
            <div class="flex items-center gap-2 flex-wrap">
                <span class="badge {{ $note->statusBadge() }}">{{ $note->statusLabel() }}</span>
                @if ($note->due_date)
                    <span @class(['badge badge-outline', 'badge-error' => $note->isOverdue()])>Термін - {{ $note->due_date->format('d.m.Y') }}</span>
                @endif
                @if ($note->isOverdue())
                    <span class="text-error text-sm">Прострочено</span>
                @endif
            </div>

            <h1 class="text-3xl font-bold">{{ $note->title }}</h1>

            <p class="whitespace-pre-line">{{ $note->body ?: 'Текст відсутній' }}</p>

            <div class="text-sm opacity-60">
                Автор - {{ $note->user->name }}. Створено {{ $note->created_at->format('d.m.Y H:i') }}, оновлено {{ $note->updated_at->format('d.m.Y H:i') }}
            </div>

            <div class="card-actions">
                <a href="{{ route('notes.index') }}" class="btn btn-ghost btn-sm">До списку</a>
                @can('update', $note)
                    <a href="{{ route('notes.edit', $note) }}" class="btn btn-outline btn-sm">Редагувати</a>
                @endcan
                @can('delete', $note)
                    <button type="button" class="btn btn-error btn-sm" onclick="document.getElementById('delete-modal').showModal()">Видалити</button>
                @endcan
            </div>
        </div>
    </div>

    @can('delete', $note)
        <dialog id="delete-modal" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Видалити нотатку?</h3>
                <p class="py-4">Нотатку "{{ $note->title }}" буде видалено без можливості відновлення.</p>
                <div class="modal-action">
                    <form method="dialog">
                        <button class="btn">Скасувати</button>
                    </form>
                    <form method="POST" action="{{ route('notes.destroy', $note) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-error">Видалити</button>
                    </form>
                </div>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>Закрити</button>
            </form>
        </dialog>
    @endcan
</x-layout>
