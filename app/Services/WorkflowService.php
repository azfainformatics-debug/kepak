<?php

namespace App\Services;

class WorkflowService
{
    public const STATUSES = [
        'DRAFT',
        'DIAJUKAN',
        'REVISI',
        'TERVERIFIKASI_OPD',
        'TERVERIFIKASI_KAB',
        'DIREVIU_APIP',
        'PERBAIKAN_APIP',
        'DISETUJUI_SEKDA',
        'DISETUJUI_BUPATI',
        'TERKIRIM',
        'DIPUBLIKASIKAN',
        'ARSIP',
    ];

    public function transition(string $module, int $entityId, string $from, string $to, int $actorId, string $note = ''): array
    {
        return [
            'module' => $module,
            'entity_id' => $entityId,
            'from_status' => $from,
            'to_status' => $to,
            'actor_id' => $actorId,
            'note' => $note,
            'logged' => true,
        ];
    }
}
