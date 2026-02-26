<?php

namespace App\Controllers\Api\V1;

class FilesController extends BaseApiController
{
    public function index() { return $this->ok(['files' => []]); }
    public function download($fileId) { return $this->ok(['file_id' => $fileId, 'action' => 'download']); }
}
