# e-Kinerja / LKjIP Kabupaten Banjar (CI4 + REST API)

Implementasi awal **MVP** aplikasi SAKIP/LKjIP Pemerintah Kabupaten Banjar berbasis **PHP 8.2, MySQL 8, CodeIgniter 4 (MVC + REST API)**.

## 1) Cakupan MVP yang sudah dibuat

- Struktur project CI4-style untuk modul API `/api/v1`.
- Route API utama sesuai kebutuhan: Auth, Master, PK, Realisasi, Dashboard/Monev, Evaluasi/Rencana Aksi, LKjIP OPD, Reviu APIP, LKjIP Kab, Publikasi/Arsip/File.
- Service workflow + daftar status dokumen standar.
- Filter placeholder untuk JWT dan RBAC.
- Migration MySQL untuk master, transaksi, dokumen, workflow, audit, parameter sistem.
- Seed role dan parameter inti.
- Dokumen OpenAPI + Postman collection.
- Wireframe UI sederhana untuk 6 layar utama.

## 2) Status Workflow standar

`DRAFT, DIAJUKAN, REVISI, TERVERIFIKASI_OPD, TERVERIFIKASI_KAB, DIREVIU_APIP, PERBAIKAN_APIP, DISETUJUI_SEKDA, DISETUJUI_BUPATI, TERKIRIM, DIPUBLIKASIKAN, ARSIP`

Semua transisi wajib ditulis ke:
- `wf_transisi` (riwayat status), dan
- `sys_audit_trail` (aksi CRUD + approval + export).

## 3) Daftar Role (RBAC)

- `ADMIN_KAB`
- `BAG_ORGANISASI`
- `BAPPELITBANG`
- `ADMIN_OPD`
- `PIC_INDIKATOR`
- `VERIFIKATOR_OPD`
- `APIP`
- `KEPALA_OPD`
- `SEKDA`
- `BUPATI`

## 4) Struktur file penting

- `app/Config/Routes.php` : routing API + wireframe.
- `app/Controllers/Api/V1/*` : controller endpoint MVP.
- `app/Services/WorkflowService.php` : definisi status workflow.
- `app/Filters/JwtAuthFilter.php`, `app/Filters/RbacFilter.php` : middleware placeholder.
- `app/Database/Migrations/*` : skema + seed awal.
- `docs/openapi.yaml` : dokumentasi OpenAPI ringkas.
- `docs/postman_collection.json` : koleksi Postman.
- `app/Views/wireframes/dashboard.php` : wireframe 6 halaman utama.

## 5) Panduan instalasi (dev)

1. Siapkan PHP 8.2+, Composer, MySQL 8.
2. Install dependency CI4 (jika project baru):
   - `composer create-project codeigniter4/appstarter .`
3. Salin file MVP ini ke project CI4.
4. Atur koneksi DB pada `.env`:
   - `database.default.hostname`
   - `database.default.database`
   - `database.default.username`
   - `database.default.password`
5. Jalankan migration:
   - `php spark migrate`
6. Jalankan server:
   - `php spark serve`
7. Akses wireframe:
   - `http://localhost:8080/wireframes`

## 6) User manual singkat per role

- **ADMIN_KAB**: setup tahun, OPD, user-role, parameter upload, audit trail, publikasi/arsip.
- **BAG_ORGANISASI**: verifikasi PK/realisasi kabupaten, gatekeeping LKjIP OPD, monitor APIP, konsolidasi LKjIP Kab, submit ke Sekda.
- **BAPPELITBANG**: sinkron sasaran-indikator-program dan dukungan monev.
- **ADMIN_OPD/PIC/VERIFIKATOR_OPD**: input target, realisasi triwulan, unggah bukti, verifikasi internal.
- **APIP**: input temuan, rekomendasi, validasi tindak lanjut sampai reviu selesai.
- **SEKDA/BUPATI**: review, approve, atau kembalikan revisi dengan catatan wajib.

## 7) Roadmap modul lengkap (pasca-MVP)

1. Implementasi Auth JWT + refresh token + rate limiting login.
2. RBAC policy matrix per endpoint + per aksi workflow.
3. Validasi bisnis detail:
   - verifikasi PK (indikator-sasaran, satuan/rumus, target);
   - verifikasi realisasi (sampling, kritikal, deviasi, bukti).
4. Snapshot tabel capaian LKjIP OPD/Kab yang immutable per versi.
5. Generator PDF final + lembar pengesahan + bukti kirim + PPID link.
6. Notifikasi (deadline TW, pengajuan, revisi, overdue rencana aksi, temuan APIP).
7. Dashboard agregasi terindeks + caching.
8. UI AdminLTE penuh dengan form CRUD dan approval flow.
