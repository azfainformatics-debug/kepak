<?php

namespace App\Models;

use CodeIgniter\Model;

class LkjipKabModel extends Model
{
    protected $table = 'doc_lkjip_kab';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tahun_id','versi','status','generated_at','submitted_to_sekda_at','approved_sekda_at','approved_bupati_at'];
}
