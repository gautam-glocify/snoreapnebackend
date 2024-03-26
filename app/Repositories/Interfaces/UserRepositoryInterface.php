<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function login($credentials);
    public function register($request);
    public function logout();
}
