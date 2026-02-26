<?php

namespace App\Controllers\Api\V1;

class RealisasiController extends MasterController
{
    public function details($id) { return $this->ok(['realisasi_id' => $id, 'details' => []]); }
    public function createDetail($id) { return $this->ok(['realisasi_id' => $id, 'action' => 'detail-created']); }
    public function updateDetails($id) { return $this->ok(['realisasi_id' => $id, 'action' => 'detail-updated']); }
    public function uploadBukti($detailId) { return $this->ok(['detail_id' => $detailId, 'action' => 'bukti-uploaded']); }
    public function listBukti($detailId) { return $this->ok(['detail_id' => $detailId, 'bukti' => []]); }
    public function deleteBukti($detailId, $fileId) { return $this->ok(['detail_id' => $detailId, 'file_id' => $fileId, 'action' => 'bukti-deleted']); }
    public function submit($id) { return $this->ok(['realisasi_id' => $id, 'action' => 'submit']); }
    public function return($id) { return $this->ok(['realisasi_id' => $id, 'action' => 'return-with-note']); }
    public function verifyOpd($id) { return $this->ok(['realisasi_id' => $id, 'action' => 'verify-opd']); }
    public function verifyKab($id) { return $this->ok(['realisasi_id' => $id, 'action' => 'verify-kab']); }
    public function lock($id) { return $this->ok(['realisasi_id' => $id, 'action' => 'locked']); }
}
