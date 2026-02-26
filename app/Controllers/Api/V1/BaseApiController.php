<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;

class BaseApiController extends ResourceController
{
    protected function ok(array $data = [], int $code = 200)
    {
        return $this->respond([
            'status' => 'success',
            'data' => $data,
        ], $code);
    }

    protected function failValidation(array $errors)
    {
        return $this->respond([
            'status' => 'error',
            'errors' => $errors,
        ], 422);
    }
}
