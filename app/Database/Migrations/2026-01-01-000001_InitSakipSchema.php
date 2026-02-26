<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InitSakipSchema extends Migration
{
    public function up()
    {
        $this->db->query('CREATE TABLE IF NOT EXISTS m_tahun_kinerja (id BIGINT PRIMARY KEY AUTO_INCREMENT, tahun SMALLINT NOT NULL UNIQUE, is_open TINYINT(1) NOT NULL DEFAULT 1, created_at DATETIME NULL, updated_at DATETIME NULL)');
        $this->db->query('CREATE TABLE IF NOT EXISTS m_opd (id BIGINT PRIMARY KEY AUTO_INCREMENT, kode VARCHAR(30) NOT NULL UNIQUE, nama VARCHAR(255) NOT NULL, aktif TINYINT(1) NOT NULL DEFAULT 1, created_at DATETIME NULL, updated_at DATETIME NULL)');
        $this->db->query('CREATE TABLE IF NOT EXISTS m_sasaran_daerah (id BIGINT PRIMARY KEY AUTO_INCREMENT, tahun_id BIGINT NOT NULL, kode VARCHAR(30) NOT NULL, uraian TEXT NOT NULL, UNIQUE KEY uq_sasaran_tahun_kode(tahun_id,kode), CONSTRAINT fk_sasaran_tahun FOREIGN KEY (tahun_id) REFERENCES m_tahun_kinerja(id))');
        $this->db->query('CREATE TABLE IF NOT EXISTS m_kamus_indikator (id BIGINT PRIMARY KEY AUTO_INCREMENT, kode VARCHAR(50) NOT NULL UNIQUE, nama VARCHAR(255) NOT NULL, definisi TEXT, rumus TEXT, satuan VARCHAR(50), frekuensi ENUM("TW1","TW2","TW3","TW4","TAHUNAN") NOT NULL, wajib_bukti TINYINT(1) NOT NULL DEFAULT 1)');
        $this->db->query('CREATE TABLE IF NOT EXISTS m_indikator_opd (id BIGINT PRIMARY KEY AUTO_INCREMENT, tahun_id BIGINT NOT NULL, opd_id BIGINT NOT NULL, sasaran_daerah_id BIGINT NOT NULL, kamus_indikator_id BIGINT NOT NULL, pic_user_id BIGINT NULL, kritikal TINYINT(1) NOT NULL DEFAULT 0, INDEX idx_indikator_opd_filter(tahun_id, opd_id), CONSTRAINT fk_indikatoropd_tahun FOREIGN KEY (tahun_id) REFERENCES m_tahun_kinerja(id), CONSTRAINT fk_indikatoropd_opd FOREIGN KEY (opd_id) REFERENCES m_opd(id), CONSTRAINT fk_indikatoropd_sasaran FOREIGN KEY (sasaran_daerah_id) REFERENCES m_sasaran_daerah(id), CONSTRAINT fk_indikatoropd_kamus FOREIGN KEY (kamus_indikator_id) REFERENCES m_kamus_indikator(id))');

        $this->db->query('CREATE TABLE IF NOT EXISTS sys_roles (id BIGINT PRIMARY KEY AUTO_INCREMENT, code VARCHAR(50) NOT NULL UNIQUE, nama VARCHAR(100) NOT NULL)');
        $this->db->query('CREATE TABLE IF NOT EXISTS sys_users (id BIGINT PRIMARY KEY AUTO_INCREMENT, opd_id BIGINT NULL, nama VARCHAR(150) NOT NULL, email VARCHAR(190) NOT NULL UNIQUE, password_hash VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL DEFAULT 1, last_login_at DATETIME NULL, CONSTRAINT fk_users_opd FOREIGN KEY (opd_id) REFERENCES m_opd(id))');
        $this->db->query('CREATE TABLE IF NOT EXISTS sys_user_roles (user_id BIGINT NOT NULL, role_id BIGINT NOT NULL, PRIMARY KEY(user_id, role_id), CONSTRAINT fk_user_roles_user FOREIGN KEY (user_id) REFERENCES sys_users(id), CONSTRAINT fk_user_roles_role FOREIGN KEY (role_id) REFERENCES sys_roles(id))');

        $this->db->query('CREATE TABLE IF NOT EXISTS trx_pk_header (id BIGINT PRIMARY KEY AUTO_INCREMENT, tahun_id BIGINT NOT NULL, opd_id BIGINT NOT NULL, status VARCHAR(30) NOT NULL DEFAULT "DRAFT", catatan_revisi TEXT NULL, submitted_at DATETIME NULL, verified_kab_at DATETIME NULL, created_by BIGINT NOT NULL, INDEX idx_pk_tahun_opd(tahun_id,opd_id), CONSTRAINT fk_pk_tahun FOREIGN KEY (tahun_id) REFERENCES m_tahun_kinerja(id), CONSTRAINT fk_pk_opd FOREIGN KEY (opd_id) REFERENCES m_opd(id))');
        $this->db->query('CREATE TABLE IF NOT EXISTS trx_pk_detail (id BIGINT PRIMARY KEY AUTO_INCREMENT, pk_id BIGINT NOT NULL, indikator_opd_id BIGINT NOT NULL, target_tahunan DECIMAL(18,4) NOT NULL, target_tw1 DECIMAL(18,4) NULL, target_tw2 DECIMAL(18,4) NULL, target_tw3 DECIMAL(18,4) NULL, target_tw4 DECIMAL(18,4) NULL, anggaran DECIMAL(18,2) NULL, CONSTRAINT fk_pkdetail_pk FOREIGN KEY (pk_id) REFERENCES trx_pk_header(id), CONSTRAINT fk_pkdetail_indikator FOREIGN KEY (indikator_opd_id) REFERENCES m_indikator_opd(id))');

        $this->db->query('CREATE TABLE IF NOT EXISTS trx_realisasi_header (id BIGINT PRIMARY KEY AUTO_INCREMENT, tahun_id BIGINT NOT NULL, triwulan TINYINT NOT NULL, opd_id BIGINT NOT NULL, status VARCHAR(30) NOT NULL DEFAULT "DRAFT", submitted_at DATETIME NULL, verified_opd_at DATETIME NULL, verified_kab_at DATETIME NULL, UNIQUE KEY uq_realisasi_periode(tahun_id,triwulan,opd_id), INDEX idx_realisasi_status(status), CONSTRAINT fk_realisasi_tahun FOREIGN KEY (tahun_id) REFERENCES m_tahun_kinerja(id), CONSTRAINT fk_realisasi_opd FOREIGN KEY (opd_id) REFERENCES m_opd(id))');
        $this->db->query('CREATE TABLE IF NOT EXISTS trx_realisasi_detail (id BIGINT PRIMARY KEY AUTO_INCREMENT, realisasi_id BIGINT NOT NULL, pk_detail_id BIGINT NOT NULL, nilai DECIMAL(18,4) NOT NULL, uraian TEXT NULL, kendala TEXT NULL, tindak_lanjut_awal TEXT NULL, diverifikasi_opd TINYINT(1) NOT NULL DEFAULT 0, diverifikasi_kab TINYINT(1) NOT NULL DEFAULT 0, CONSTRAINT fk_realisasidetail_header FOREIGN KEY (realisasi_id) REFERENCES trx_realisasi_header(id), CONSTRAINT fk_realisasidetail_pkdetail FOREIGN KEY (pk_detail_id) REFERENCES trx_pk_detail(id))');
        $this->db->query('CREATE TABLE IF NOT EXISTS trx_bukti_dukung (id BIGINT PRIMARY KEY AUTO_INCREMENT, realisasi_detail_id BIGINT NOT NULL, file_path VARCHAR(255) NOT NULL, file_name VARCHAR(255) NOT NULL, mime_type VARCHAR(100) NOT NULL, file_size BIGINT NOT NULL, source_link VARCHAR(255) NULL, uploaded_by BIGINT NOT NULL, uploaded_at DATETIME NOT NULL, CONSTRAINT fk_bukti_detail FOREIGN KEY (realisasi_detail_id) REFERENCES trx_realisasi_detail(id))');

        $this->db->query('CREATE TABLE IF NOT EXISTS doc_lkjip_opd (id BIGINT PRIMARY KEY AUTO_INCREMENT, tahun_id BIGINT NOT NULL, opd_id BIGINT NOT NULL, versi INT NOT NULL DEFAULT 1, status VARCHAR(30) NOT NULL DEFAULT "DRAFT", generated_at DATETIME NOT NULL, submitted_at DATETIME NULL, reviewed_at DATETIME NULL, UNIQUE KEY uq_lkjipopd_ver(tahun_id,opd_id,versi), CONSTRAINT fk_lkjipopd_tahun FOREIGN KEY (tahun_id) REFERENCES m_tahun_kinerja(id), CONSTRAINT fk_lkjipopd_opd FOREIGN KEY (opd_id) REFERENCES m_opd(id))');
        $this->db->query('CREATE TABLE IF NOT EXISTS doc_lkjip_opd_bab (id BIGINT PRIMARY KEY AUTO_INCREMENT, lkjip_opd_id BIGINT NOT NULL, bab_no TINYINT NOT NULL, judul VARCHAR(255) NOT NULL, konten_html LONGTEXT NULL, quality_checked TINYINT(1) NOT NULL DEFAULT 0, catatan_qc TEXT NULL, UNIQUE KEY uq_lkjipopd_bab(lkjip_opd_id,bab_no), CONSTRAINT fk_lkjipopd_bab_header FOREIGN KEY (lkjip_opd_id) REFERENCES doc_lkjip_opd(id))');
        $this->db->query('CREATE TABLE IF NOT EXISTS doc_lkjip_kab (id BIGINT PRIMARY KEY AUTO_INCREMENT, tahun_id BIGINT NOT NULL, versi INT NOT NULL DEFAULT 1, status VARCHAR(30) NOT NULL DEFAULT "DRAFT", generated_at DATETIME NOT NULL, submitted_to_sekda_at DATETIME NULL, approved_sekda_at DATETIME NULL, approved_bupati_at DATETIME NULL, UNIQUE KEY uq_lkjipkab_ver(tahun_id,versi), CONSTRAINT fk_lkjipkab_tahun FOREIGN KEY (tahun_id) REFERENCES m_tahun_kinerja(id))');

        $this->db->query('CREATE TABLE IF NOT EXISTS doc_reviu_apip_header (id BIGINT PRIMARY KEY AUTO_INCREMENT, entity_type ENUM("LKJIP_OPD","LKJIP_KAB") NOT NULL, entity_id BIGINT NOT NULL, status VARCHAR(30) NOT NULL DEFAULT "DRAFT", reviu_mulai DATE NULL, reviu_selesai DATE NULL)');
        $this->db->query('CREATE TABLE IF NOT EXISTS doc_reviu_apip_temuan (id BIGINT PRIMARY KEY AUTO_INCREMENT, reviu_id BIGINT NOT NULL, judul VARCHAR(255) NOT NULL, rekomendasi TEXT NOT NULL, status_tindak_lanjut VARCHAR(30) NOT NULL DEFAULT "OPEN", CONSTRAINT fk_temuan_reviu FOREIGN KEY (reviu_id) REFERENCES doc_reviu_apip_header(id))');

        $this->db->query('CREATE TABLE IF NOT EXISTS wf_transisi (id BIGINT PRIMARY KEY AUTO_INCREMENT, module VARCHAR(50) NOT NULL, entity_id BIGINT NOT NULL, from_status VARCHAR(30) NOT NULL, to_status VARCHAR(30) NOT NULL, note TEXT NULL, actor_id BIGINT NOT NULL, created_at DATETIME NOT NULL, INDEX idx_wf_entity(module, entity_id, created_at))');
        $this->db->query('CREATE TABLE IF NOT EXISTS sys_audit_trail (id BIGINT PRIMARY KEY AUTO_INCREMENT, user_id BIGINT NOT NULL, module VARCHAR(50) NOT NULL, action VARCHAR(50) NOT NULL, entity_type VARCHAR(50) NOT NULL, entity_id BIGINT NOT NULL, before_data JSON NULL, after_data JSON NULL, ip_address VARCHAR(45) NULL, user_agent VARCHAR(255) NULL, created_at DATETIME NOT NULL, INDEX idx_audit_filter(module, user_id, created_at))');
        $this->db->query('CREATE TABLE IF NOT EXISTS sys_parameter (id BIGINT PRIMARY KEY AUTO_INCREMENT, code VARCHAR(100) NOT NULL UNIQUE, value TEXT NOT NULL, description TEXT NULL)');
    }

    public function down()
    {
        $tables = ['sys_parameter','sys_audit_trail','wf_transisi','doc_reviu_apip_temuan','doc_reviu_apip_header','doc_lkjip_kab','doc_lkjip_opd_bab','doc_lkjip_opd','trx_bukti_dukung','trx_realisasi_detail','trx_realisasi_header','trx_pk_detail','trx_pk_header','sys_user_roles','sys_users','sys_roles','m_indikator_opd','m_kamus_indikator','m_sasaran_daerah','m_opd','m_tahun_kinerja'];
        foreach ($tables as $table) {
            $this->db->query("DROP TABLE IF EXISTS {$table}");
        }
    }
}
