<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DivisionController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Input pencarian tidak valid',
                'errors' => $validator->errors()
            ], 422);
        }

        $divisions = Division::query()
            ->when($request->name, function ($query, $name) {
                return $query->where('name', 'like', "%{$name}%");
            })
            ->paginate(5);

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
            ]
        ]);
    }
}