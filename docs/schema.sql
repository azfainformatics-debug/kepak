-- Ringkasan DDL MVP e-Kinerja/LKjIP Banjar (MySQL 8)
-- Sumber utama tetap migration CI4 di app/Database/Migrations.
CREATE TABLE m_workflow_status (
  code VARCHAR(30) PRIMARY KEY,
  label VARCHAR(50) NOT NULL
);

INSERT INTO m_workflow_status(code,label) VALUES
('DRAFT','Draft'),('DIAJUKAN','Diajukan'),('REVISI','Revisi'),('TERVERIFIKASI_OPD','Terverifikasi OPD'),
('TERVERIFIKASI_KAB','Terverifikasi Kabupaten'),('DIREVIU_APIP','Direviu APIP'),('PERBAIKAN_APIP','Perbaikan APIP'),
('DISETUJUI_SEKDA','Disetujui Sekda'),('DISETUJUI_BUPATI','Disetujui Bupati'),('TERKIRIM','Terkirim'),
('DIPUBLIKASIKAN','Dipublikasikan'),('ARSIP','Arsip');
