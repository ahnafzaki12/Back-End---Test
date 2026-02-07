<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
            'division_id' => 'nullable|exists:divisions,id'
        ]);

        $query = Employee::with('division');

        $query->when($request->name, function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->name . '%');
        });

        $query->when($request->division_id, function ($q) use ($request) {
            return $q->where('division_id', $request->division_id);
        });

        $employees = $query->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil data karyawan',
            'data' => [
                'employees' => EmployeeResource::collection($employees),
            ],
            'pagination' => [
                'total' => $employees->total(),
                'count' => $employees->count(),
                'per_page' => $employees->perPage(),
                'current_page' => $employees->currentPage(),
                'total_pages' => $employees->lastPage(),
                'links' => [
                    'next' => $employees->nextPageUrl(),
                    'prev' => $employees->previousPageUrl(),
                ]
            ]
        ]);
    }
}
