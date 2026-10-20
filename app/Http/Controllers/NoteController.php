<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use App\Notifications\NotePublished;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Note::class);

        $notes = $request->user()->notes()->latest()->get();

        return view('notes.index', ['notes' => $notes]);
    }

    public function create()
    {
        Gate::authorize('create', Note::class);

        return view('notes.create');
    }

    public function store(StoreNoteRequest $request)
    {
        Gate::authorize('create', Note::class);

        $note = $request->user()->notes()->create($request->validated());

        $request->user()->notify(new NotePublished($note));

        return redirect()->route('notes.show', $note)->with('success', 'Нотатку створено');
    }

    public function show(Note $note)
    {
        Gate::authorize('view', $note);

        return view('notes.show', ['note' => $note]);
    }

    public function edit(Note $note)
    {
        Gate::authorize('update', $note);

        return view('notes.edit', ['note' => $note]);
    }

    public function update(UpdateNoteRequest $request, Note $note)
    {
        Gate::authorize('update', $note);

        $note->update($request->validated());

        return redirect()->route('notes.show', $note)->with('success', 'Нотатку оновлено');
    }

    public function destroy(Note $note)
    {
        Gate::authorize('delete', $note);

        $note->delete();

        return redirect()->route('notes.index')->with('success', 'Нотатку видалено');
    }
}
