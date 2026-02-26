<?php

namespace App\Controllers\Api\V1;

class DashboardController extends BaseApiController
{
    public function summary() { return $this->ok(['heatmap' => [], 'queue_verifikasi' => [], 'opd_terlambat' => []]); }
    public function opd() { return $this->ok(['drilldown' => []]); }
    public function sasaran() { return $this->ok(['sasaran' => []]); }
}
