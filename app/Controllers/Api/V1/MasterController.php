<?php

namespace App\Controllers\Api\V1;

class MasterController extends BaseApiController
{
    public function index() { return $this->ok(['items' => [], 'module' => 'master']); }
    public function show($id = null) { return $this->ok(['id' => $id]); }
    public function create() { return $this->ok(['message' => 'created'], 201); }
    public function update($id = null) { return $this->ok(['message' => 'updated', 'id' => $id]); }
    public function delete($id = null) { return $this->ok(['message' => 'deleted', 'id' => $id]); }
}
