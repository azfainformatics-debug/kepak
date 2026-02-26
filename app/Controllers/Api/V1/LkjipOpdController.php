<?php

namespace App\Controllers\Api\V1;

class LkjipOpdController extends BaseApiController
{
    public function generate() { return $this->ok(['action' => 'generate-lkjip-opd']); }
    public function show($id) { return $this->ok(['id' => $id]); }
    public function update($id) { return $this->ok(['id' => $id, 'action' => 'update']); }
    public function bab($id) { return $this->ok(['id' => $id, 'bab' => []]); }
    public function updateBab($id) { return $this->ok(['id' => $id, 'action' => 'update-bab']); }
    public function submit($id) { return $this->ok(['id' => $id, 'action' => 'submit']); }
    public function return($id) { return $this->ok(['id' => $id, 'action' => 'return-with-note']); }
    public function approveKepalaOpd($id) { return $this->ok(['id' => $id, 'action' => 'approve-kepala-opd']); }
    public function exportPdf($id) { return $this->ok(['id' => $id, 'action' => 'export-pdf']); }
}
