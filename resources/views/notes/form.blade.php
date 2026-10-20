@php
    $note = $note ?? null;
@endphp

<fieldset class="fieldset">
    <legend class="fieldset-legend">Назва</legend>
    <input type="text" name="title" value="{{ old('title', $note?->title) }}" @class(['input w-full', 'input-error' => $errors->has('title')])>
    @error('title')
        <p class="text-error text-sm">{{ $message }}</p>
    @enderror
</fieldset>

<fieldset class="fieldset">
    <legend class="fieldset-legend">Текст</legend>
    <textarea name="body" rows="5" @class(['textarea w-full', 'textarea-error' => $errors->has('body')])>{{ old('body', $note?->body) }}</textarea>
    @error('body')
        <p class="text-error text-sm">{{ $message }}</p>
    @enderror
</fieldset>

<div class="grid gap-4 sm:grid-cols-2">
    <fieldset class="fieldset">
        <legend class="fieldset-legend">Статус</legend>
        <select name="status" @class(['select w-full', 'select-error' => $errors->has('status')])>
            @foreach (\App\Models\Note::STATUSES as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $note?->status ?? 'todo') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('status')
            <p class="text-error text-sm">{{ $message }}</p>
        @enderror
    </fieldset>

    <fieldset class="fieldset">
        <legend class="fieldset-legend">Термін виконання</legend>
        <input type="date" name="due_date" value="{{ old('due_date', $note?->due_date?->format('Y-m-d')) }}" @class(['input w-full', 'input-error' => $errors->has('due_date')])>
        @error('due_date')
            <p class="text-error text-sm">{{ $message }}</p>
        @enderror
    </fieldset>
</div>
