<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Carbon;

class UserService
{
    public function __construct(private Authenticatable|User $user = new User())
    {

    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|\App\Models\User
     */
    public function getUser(): Authenticatable|User
    {
        return $this->user;
    }

    /**
     * @param string $name
     * @param string $email
     * @param string|null $password
     * @param \Illuminate\Support\Carbon|null $email_verified_at
     * @return $this
     */
    public function assignData(
        string  $name,
        string  $email,
        ?string $password = null,
        ?Carbon $email_verified_at = null
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
        $this->user->save();
        return $this;
    }
}
