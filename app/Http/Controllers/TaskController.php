<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Throwable;

class TaskController extends Controller
{
    public const TITLES = [
        1 => 'Laravel Herd та новий проєкт',
        2 => 'Маршрути, шаблони та форми',
        3 => 'CRUD нотаток, валідація та API',
        4 => 'Tailwind CSS та daisyUI',
        5 => 'Реєстрація, вхід та власники',
        6 => 'Авторизація - Gate та Policy',
        7 => 'Sass, сповіщення, черги та тести',
    ];

    public function show(Request $request, int $number)
    {
        abort_unless(array_key_exists($number, self::TITLES), 404);

        return view('tasks.task'.$number, array_merge(
            ['number' => $number, 'title' => self::TITLES[$number]],
            $this->data($request, $number)
        ));
    }

    private function data(Request $request, int $number): array
    {
        return match ($number) {
            1 => ['environment' => $this->environment($request)],
            7 => $this->queueData($request),
            default => [],
        };
    }

    private function environment(Request $request): array
    {
        try {
            DB::connection()->getPdo();
            $database = 'Підключено ('.config('database.default').')';
        } catch (Throwable $e) {
            $database = 'Помилка - '.$e->getMessage();
        }

        return [
            'Версія PHP' => PHP_VERSION,
            'Версія Laravel' => app()->version(),
            'Веб-сервер' => $request->server('SERVER_SOFTWARE', 'невідомо'),
            'Інтерфейс PHP' => PHP_SAPI,
            'Середовище' => app()->environment(),
            'Адреса застосунку' => config('app.url'),
            'База даних' => $database,
            'Кількість розширень PHP' => count(get_loaded_extensions()),
            'Папка проєкту' => base_path(),
            'Час сервера' => now()->format('d.m.Y H:i:s'),
        ];
    }

    private function queueData(Request $request): array
    {
        $hasNotifications = Schema::hasTable('notifications');
        $hasJobs = Schema::hasTable('jobs');

        return [
            'hasNotifications' => $hasNotifications,
            'notifications' => $hasNotifications && $request->user()
                ? $request->user()->notifications()->latest()->take(10)->get()
                : collect(),
            'jobs' => $hasJobs ? DB::table('jobs')->orderByDesc('id')->take(10)->get() : collect(),
            'failedJobs' => Schema::hasTable('failed_jobs') ? DB::table('failed_jobs')->count() : 0,
            'mailer' => config('mail.default'),
            'queue' => config('queue.default'),
        ];
    }
}
