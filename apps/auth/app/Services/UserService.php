<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Carbon;

class UserService
{
    public function __construct(private Authenticatable|User $user = new User())
    {

    }

    /**
     * @return \App\Models\User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param string $name
     * @param string $email
     * @param string|null $password
     * @param \Illuminate\Support\Carbon|null $email_verified_at
     * @param \App\Models\Role|null $role
     * @return $this
     */
    public function assignData(
        string  $name,
        string  $email,
        ?string $password = null,
        ?Carbon $email_verified_at = null,
        ?Role   $role = null,
    ): static
    {
        $this->user->name = $name;
        $this->user->email = $email;
        if ($password) {
            $this->user->password = bcrypt($password);
        }
        if ($email_verified_at) {
            $this->user->email_verified_at = $email_verified_at;
        }

        if (!$role && !$this->user->role) {
            $this->user->role_id = Role::first()->id;
        } else {
            $this->user->role_id = $role->id;
        }

        $this->user->save();
        return $this;
    }
}
