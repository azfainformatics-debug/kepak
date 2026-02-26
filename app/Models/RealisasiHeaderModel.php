<?php

namespace App\Models;

use CodeIgniter\Model;

class RealisasiHeaderModel extends Model
{
    protected $table = 'trx_realisasi_header';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tahun_id','triwulan','opd_id','status','submitted_at','verified_opd_at','verified_kab_at'];
}
