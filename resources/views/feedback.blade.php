<x-layout title="Форма зворотного зв'язку" active="2">
    <div class="grid gap-6 lg:grid-cols-2">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h1 class="card-title text-2xl">Форма зворотного зв'язку</h1>

                @if (session('last_name'))
                    <p class="text-sm">Останнє повідомлення надіслав(ла): <strong>{{ session('last_name') }}</strong></p>
                @endif

                <form method="POST" action="{{ route('feedback.store') }}" class="space-y-3">
                    @csrf

                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Ім'я</legend>
                        <input type="text" name="name" value="{{ old('name') }}" @class(['input w-full', 'input-error' => $errors->has('name')])>
                        @error('name')
                            <p class="text-error text-sm">{{ $message }}</p>
                        @enderror
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Повідомлення</legend>
                        <textarea name="message" rows="4" @class(['textarea w-full', 'textarea-error' => $errors->has('message')])>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-error text-sm">{{ $message }}</p>
                        @enderror
                    </fieldset>

                    <button type="submit" class="btn btn-primary">Надіслати</button>
                </form>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <h2 class="card-title">Збережено в сесії - {{ count($messages) }}</h2>
                    @if (count($messages))
                        <form method="POST" action="{{ route('feedback.destroy') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-ghost">Очистити</button>
                        </form>
                    @endif
                </div>

                @forelse (array_reverse($messages) as $item)
                    <div class="border border-base-300 rounded-box p-3">
                        <div class="flex justify-between text-sm opacity-70">
                            <span class="font-semibold">{{ $item['name'] }}</span>
                            <span>{{ $item['time'] }}</span>
                        </div>
                        <p class="mt-1">{{ $item['message'] }}</p>
                    </div>
                @empty
                    <p class="opacity-70">Повідомлень поки немає.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layout>
