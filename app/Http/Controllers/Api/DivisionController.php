<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
        ]);

        $divisions = Division::query()
            ->when($request->name, function ($query, $name) {
                return $query->where('name', 'like', "%{$name}%");
            })
            ->select('id', 'name')
            ->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil data divisi',
            'data' => [
                'divisions' => $divisions->items(),
            ],
            'pagination' => [
                'current_page' => $divisions->currentPage(),
                'last_page'    => $divisions->lastPage(),
                'per_page'     => $divisions->perPage(),
                'total'        => $divisions->total(),
                'links' => [
                    'next' => $divisions->nextPageUrl(),
                    'prev' => $divisions->previousPageUrl(),
                ]
            ]
        ]);
    }
}
