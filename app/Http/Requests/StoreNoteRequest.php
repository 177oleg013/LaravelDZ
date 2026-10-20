<?php

namespace App\Http\Requests;

use App\Models\Note;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreNoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'body' => ['nullable', 'string', 'max:5000'],
            'status' => ['required', Rule::in(array_keys(Note::STATUSES))],
            'due_date' => ['nullable', 'date', 'after_or_equal:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Вкажіть назву нотатки',
            'title.min' => 'Назва має містити щонайменше :min символи',
            'title.max' => 'Назва не може бути довшою за :max символів',
            'body.max' => 'Текст не може перевищувати :max символів',
            'status.required' => 'Оберіть статус',
            'status.in' => 'Обраний статус не підтримується',
            'due_date.date' => 'Вкажіть коректну дату',
            'due_date.after_or_equal' => 'Термін не може бути в минулому',
        ];
    }
}
