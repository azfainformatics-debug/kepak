<?php

namespace App\Models;

use CodeIgniter\Model;

class PkHeaderModel extends Model
{
    protected $table = 'trx_pk_header';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tahun_id','opd_id','status','catatan_revisi','submitted_at','verified_kab_at','created_by'];
}
