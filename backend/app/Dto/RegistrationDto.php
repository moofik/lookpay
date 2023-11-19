<?php

namespace App\Dto;

use App\Models\User;
use Laravel\Sanctum\NewAccessToken;

class RegistrationDto
{
    public User $user;
    public NewAccessToken $token;
    public string $password;
}