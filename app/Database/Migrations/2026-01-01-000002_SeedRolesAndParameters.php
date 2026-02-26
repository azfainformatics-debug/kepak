<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SeedRolesAndParameters extends Migration
{
    public function up()
    {
        $roles = ['ADMIN_KAB','BAG_ORGANISASI','BAPPELITBANG','ADMIN_OPD','PIC_INDIKATOR','VERIFIKATOR_OPD','APIP','KEPALA_OPD','SEKDA','BUPATI'];
        foreach ($roles as $role) {
            $this->db->query('INSERT INTO sys_roles(code, nama) VALUES(?, ?)', [$role, str_replace('_', ' ', $role)]);
        }

        $params = [
            ['UPLOAD_MAX_MB', '10', 'Maksimal ukuran file bukti dukung dalam MB'],
            ['UPLOAD_ALLOWED_EXT', 'pdf,jpg,jpeg,png', 'Whitelist ekstensi bukti dukung'],
            ['LKJIP_KONSOLIDASI_REQUIRE_REVIU_SELESAI', '1', 'Hanya ambil LKjIP OPD final/reviu selesai'],
        ];

        foreach ($params as [$code, $value, $description]) {
            $this->db->query('INSERT INTO sys_parameter(code, value, description) VALUES(?, ?, ?)', [$code, $value, $description]);
        }
    }

    public function down()
    {
        $this->db->query('DELETE FROM sys_roles');
        $this->db->query('DELETE FROM sys_parameter');
    }
}
