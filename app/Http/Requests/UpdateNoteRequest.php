<?php

namespace App\Http\Requests;

use App\Models\Note;
use Illuminate\Validation\Rule;

class UpdateNoteRequest extends StoreNoteRequest
{
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'min:3', 'max:255'],
            'body' => ['nullable', 'string', 'max:5000'],
            'status' => ['sometimes', 'required', Rule::in(array_keys(Note::STATUSES))],
            'due_date' => ['nullable', 'date'],
        ];
    }
}
