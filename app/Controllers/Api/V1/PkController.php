<?php

namespace App\Controllers\Api\V1;

class PkController extends MasterController
{
    public function generateDetails($id) { return $this->ok(['pk_id' => $id, 'action' => 'generate-details']); }
    public function details($id) { return $this->ok(['pk_id' => $id, 'details' => []]); }
    public function updateDetails($id) { return $this->ok(['pk_id' => $id, 'action' => 'update-details']); }
    public function submit($id) { return $this->ok(['pk_id' => $id, 'action' => 'submit']); }
    public function return($id) { return $this->ok(['pk_id' => $id, 'action' => 'return-with-note']); }
    public function verifyKab($id) { return $this->ok(['pk_id' => $id, 'action' => 'verify-kab']); }
    public function approveKepalaOpd($id) { return $this->ok(['pk_id' => $id, 'action' => 'approve-kepala-opd']); }
}
