<?php

namespace App\Controllers\Api\V1;

class AuthController extends BaseApiController
{
    public function login() { return $this->ok(['message' => 'Login endpoint MVP']); }
    public function logout() { return $this->ok(['message' => 'Logout endpoint MVP']); }
    public function me() { return $this->ok(['message' => 'Me endpoint MVP']); }
    public function updateProfile() { return $this->ok(['message' => 'Update profile endpoint MVP']); }
}
