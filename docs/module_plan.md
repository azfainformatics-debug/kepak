# Rencana Modul Lengkap (Setelah MVP)

## Tahap 1 (MVP - sudah tersedia)
- Routing API dan controller skeleton seluruh domain.
- Migration inti: master, transaksi, dokumen, workflow, audit trail.
- Wireframe UI 6 modul prioritas Bagian Organisasi.

## Tahap 2 (Fungsional inti)
- Implementasi model-repository-service per domain.
- Workflow engine dengan matrix transisi per role.
- Validasi bisnis verifikasi PK/realisasi + checklist gatekeeping LKjIP OPD.
- Snapshot data capaian immutable untuk dokumen LKjIP.

## Tahap 3 (Dokumen & approval)
- Generator LKjIP OPD/Kab dari snapshot + editor bab.
- Proses reviu APIP end-to-end (temuan, rekomendasi, tindak lanjut, bukti).
- Approval Sekda/Bupati + histori perubahan + versioning.

## Tahap 4 (Operasional)
- Notifikasi in-app + email + reminder deadline.
- Export PDF final + lembar pengesahan + arsip + publikasi PPID.
- Dashboard agregasi performa tinggi + cache + job queue.
