<?php

namespace App\Controllers\Api\V1;

class LkjipKabController extends LkjipOpdController
{
    public function approveSekda($id) { return $this->ok(['id' => $id, 'action' => 'approve-sekda']); }
    public function approveBupati($id) { return $this->ok(['id' => $id, 'action' => 'approve-bupati']); }
}
