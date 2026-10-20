<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function create(Request $request)
    {
        return view('feedback', [
            'messages' => $request->session()->get('feedback', []),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'message' => ['required', 'string', 'min:5', 'max:1000'],
        ], [
            'name.required' => 'Вкажіть ім\'я',
            'message.required' => 'Напишіть повідомлення',
            'message.min' => 'Повідомлення має містити щонайменше :min символів',
        ]);

        $request->session()->push('feedback', [
            'name' => $data['name'],
            'message' => $data['message'],
            'time' => now()->format('d.m.Y H:i:s'),
        ]);

        return redirect()
            ->route('feedback.create')
            ->with('success', 'Дякуємо, '.$data['name'].'! Повідомлення збережено в сесії')
            ->with('last_name', $data['name']);
    }

    public function destroy(Request $request)
    {
        $request->session()->forget('feedback');

        return redirect()->route('feedback.create')->with('success', 'Сесію очищено');
    }
}
