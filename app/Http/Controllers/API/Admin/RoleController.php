<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('users')->latest()->paginate(10);
        return response()->json([
            'status' => 'success',
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'description' => 'required|string'
        ]);

        $role = Role::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Role created successfully',
            'role' => $role
        ], 201);
    }

    public function show(Role $role)
    {
        return response()->json([
            'status' => 'success',
            'role' => $role->load('users')
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255|unique:roles,name,' . $role->id,
            'description' => 'sometimes|required|string'
        ]);

        $role->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Role updated successfully',
            'role' => $role->fresh()
        ]);
    }

    public function destroy(Role $role)
    {
        if ($role->users()->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot delete role with associated users'
            ], 409);
        }

        $role->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Role deleted successfully'
        ]);
    }
}
