<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @param \App\Models\User $user
     */
    public function __construct(private User $user = new User())
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
     * @param string $password
     * @return $this
     */
    public function assignData(
        string $name,
        string $email,
        string $password
    ): static
    {

        $this->user->name = $name;
        $this->user->email = $email;
        $this->user->password = Hash::make($password);
        $this->user->save();

        return $this;
    }


}
