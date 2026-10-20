<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NotePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Note $note): Response
    {
        return $this->owns($user, $note);
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Note $note): Response
    {
        return $this->owns($user, $note);
    }

    public function delete(User $user, Note $note): Response
    {
        return $this->owns($user, $note);
    }

    private function owns(User $user, Note $note): Response
    {
        return (int) $note->user_id === (int) $user->id
            ? Response::allow()
            : Response::denyAsNotFound();
    }
}
