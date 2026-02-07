<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'name'     => 'required|string|max:255',
            'phone'    => 'required|string|max:20',
            'division' => 'required|exists:divisions,id', 
            'position' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => $validator->errors()->first(),
            ], 422);
        }

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('employees', 'public');
                $imagePath = $path;
            }

            Employee::create([
                'image'       => $imagePath, 
                'name'        => $request->name,
                'phone'       => $request->phone,
                'division_id' => $request->division,
                'position'    => $request->position,
            ]);

            return response()->json([
                'status'  => 'success',
                'message' => 'Karyawan berhasil ditambahkan',
            ], 201); 

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi kesalahan pada server',
            ], 500);
        }
    }
}
