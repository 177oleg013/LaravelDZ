<x-layout title="Реєстрація" active="5">
    <div class="card bg-base-100 shadow-sm max-w-md mx-auto">
        <div class="card-body">
            <h1 class="card-title text-2xl">Реєстрація</h1>

            <form method="POST" action="{{ route('register') }}" class="space-y-2">
                @csrf

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Ім'я</legend>
                    <input type="text" name="name" value="{{ old('name') }}" @class(['input w-full', 'input-error' => $errors->has('name')]) required>
                    @error('name')
                        <p class="text-error text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

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

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Підтвердження пароля</legend>
                    <input type="password" name="password_confirmation" class="input w-full" required>
                </fieldset>

                <button type="submit" class="btn btn-primary w-full">Зареєструватися</button>
            </form>

            <p class="text-sm text-center">Вже маєте акаунт? <a href="{{ route('login') }}" class="link link-primary">Увійти</a></p>
        </div>
    </div>
</x-layout>
