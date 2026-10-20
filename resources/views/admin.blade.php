<x-layout title="Адміністрування" active="6">
    <div class="card bg-base-100 shadow-sm">
        <div class="card-body">
            <h1 class="card-title text-2xl">Панель адміністратора</h1>
            <p class="opacity-70">Сторінка захищена Gate "view-admin". Користувач без прав адміністратора отримує 404.</p>

            <h2 class="font-semibold mt-4">Користувачі</h2>
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ім'я</th>
                            <th>Email</th>
                            <th>Роль</th>
                            <th>Нотаток</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span @class(['badge', 'badge-primary' => $user->is_admin, 'badge-ghost' => ! $user->is_admin])>{{ $user->is_admin ? 'адміністратор' : 'користувач' }}</span>
                                </td>
                                <td>{{ $user->notes_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h2 class="font-semibold mt-4">Усі нотатки</h2>
            <p class="text-sm opacity-70">Посилання на чужі нотатки повертають 404, бо NotePolicy дозволяє доступ лише власнику.</p>
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Назва</th>
                            <th>Власник</th>
                            <th>Статус</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notes as $note)
                            <tr>
                                <td>{{ $note->id }}</td>
                                <td>{{ $note->title }}</td>
                                <td>{{ $note->user->name }}</td>
                                <td><span class="badge {{ $note->statusBadge() }}">{{ $note->statusLabel() }}</span></td>
                                <td><a href="{{ route('notes.show', $note) }}" class="link">{{ url('/notes/'.$note->id) }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
