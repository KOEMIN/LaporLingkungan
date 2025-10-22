<?php

namespace App\Policies;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LaporanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Laporan $laporan): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
// app/Policies/LaporanPolicy.php

public function update(User $user, Laporan $laporan): bool
{
    // Admin boleh update kapan saja
    if ($user->isAdmin()) {
        return true;
    }
    // User biasa hanya boleh update jika dia pemilik DAN status masih 'Dilaporkan'
    return $user->id === $laporan->user_id && $laporan->status === 'Dilaporkan';
}

public function delete(User $user, Laporan $laporan): bool
{
    // Admin boleh hapus kapan saja
    if ($user->isAdmin()) {
        return true;
    }
    // User biasa hanya boleh hapus jika dia pemilik DAN status masih 'Dilaporkan'
    return $user->id === $laporan->user_id && $laporan->status === 'Dilaporkan';
}

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Laporan $laporan): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Laporan $laporan): bool
    {
        return false;
    }
}
