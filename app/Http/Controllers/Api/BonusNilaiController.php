<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BonusNilaiController extends Controller
{
    public function nilaiRT()
    {
        $results = DB::connection('mysql_bonus')
            ->table('nilai')
            ->select('nama', 'nisn', 'nama_pelajaran', 'skor')
            ->where('materi_uji_id', 7)
            ->where('nama_pelajaran', 'NOT LIKE', '%pelajaran_khusus%')
            ->get();

        $data = $results->groupBy('nisn')->map(function ($items) {
            $first = $items->first();
            $nilaiRt = [];

            foreach ($items as $item) {
                $key = strtolower($item->nama_pelajaran);
                $nilaiRt[$key] = (float)$item->skor;
            }

            return [
                'nama' => $first->nama,
                'nilaiRt' => $nilaiRt, 
                'nisn' => $first->nisn,
            ];
        })->values(); 

        return response()->json($data);
    }

    public function nilaiST()
    {
        $results = DB::connection('mysql_bonus')
            ->table('nilai')
            ->select([
                'nama',
                'nisn',
                'nama_pelajaran',
                DB::raw("
                CASE 
                    WHEN pelajaran_id = 44 THEN skor * 41.67
                    WHEN pelajaran_id = 45 THEN skor * 29.67
                    WHEN pelajaran_id = 46 THEN skor * 100
                    WHEN pelajaran_id = 47 THEN skor * 23.81
                    ELSE skor 
                END as skor_bobot
            ")
            ])
            ->where('materi_uji_id', 4)
            ->get();

        $data = $results->groupBy('nisn')->map(function ($items) {
            $first = $items->first();
            $listNilai = [];

            foreach ($items as $item) {
                $key = strtolower($item->nama_pelajaran);
                $listNilai[$key] = round($item->skor_bobot, 2);
            }

            return [
                'nama' => $first->nama,
                'nisn' => $first->nisn,
                'listNilai' => $listNilai,
                'total' => round(array_sum($listNilai), 2)
            ];
        })->values()->sortByDesc('total')->values();

        return response()->json($data);
    }
}
