<x-layout title="Вхід" active="5">
    <div class="card bg-base-100 shadow-sm max-w-md mx-auto">
        <div class="card-body">
            <h1 class="card-title text-2xl">Вхід</h1>

            <form method="POST" action="{{ route('login') }}" class="space-y-2">
                @csrf

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Email</legend>
                    <input type="email" name="email" value="{{ old('email') }}" @class(['input w-full', 'input-error' => $errors->has('email')]) required>
                    @error('email')
                        <p class="text-error text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Пароль</legend>
                    <input type="password" name="password" @class(['input w-full', 'input-error' => $errors->has('password')]) required>
                    @error('password')
                        <p class="text-error text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <label class="label cursor-pointer gap-2">
                    <input type="checkbox" name="remember" class="checkbox checkbox-sm">
                    <span>Запам'ятати мене</span>
                </label>

                <button type="submit" class="btn btn-primary w-full">Увійти</button>
            </form>

            <p class="text-sm text-center">Немає акаунта? <a href="{{ route('register') }}" class="link link-primary">Зареєструватися</a></p>
        </div>
    </div>
</x-layout>
