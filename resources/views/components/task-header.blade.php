@props(['number', 'title'])

<div class="hero bg-base-100 rounded-box shadow-sm">
    <div class="hero-content w-full justify-start py-8">
        <div>
            <div class="badge badge-primary badge-lg mb-3">Завдання {{ $number }}</div>
            <h1 class="text-3xl font-bold">{{ $title }}</h1>
            @if ($slot->isNotEmpty())
                <p class="mt-3 opacity-80 max-w-3xl">{{ $slot }}</p>
            @endif
        </div>
    </div>
</div>
