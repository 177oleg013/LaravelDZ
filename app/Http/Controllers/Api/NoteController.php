<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class NoteController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        Gate::authorize('viewAny', Note::class);

        return response()->json($request->user()->notes()->latest()->get());
    }

    public function store(StoreNoteRequest $request): JsonResponse
    {
        Gate::authorize('create', Note::class);

        $note = $request->user()->notes()->create($request->validated());

        return response()->json($note, 201);
    }

    public function show(Note $note): JsonResponse
    {
        Gate::authorize('view', $note);

        return response()->json($note);
    }

    public function update(UpdateNoteRequest $request, Note $note): JsonResponse
    {
        Gate::authorize('update', $note);

        $note->update($request->validated());

        return response()->json($note->fresh(), 200);
    }

    public function destroy(Note $note): Response
    {
        Gate::authorize('delete', $note);

        $note->delete();

        return response()->noContent();
    }
}
