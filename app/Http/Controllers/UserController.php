<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // បង្ហាញទំព័រមើលបញ្ជី users
public function index(Request $request)
    {
        if ($request->ajax()) {
        $users = User::select(['id', 'name', 'username', 'email', 'phone','profile_image', 'role_id', 'status','created_at']);

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('status_label', function ($user) {
                if ($user->status == 1) {
                    return '<span class="badge bg-success">Active</span>';
                } else {
                    return '<span class="badge bg-danger">Inactive</span>';
                }
            })
            ->addColumn('role', function ($user) {
                switch ($user->role_id) {
                    case 1:
                        return 'Admin';
                    case 2:
                        return 'User';
                    default:
                        return 'Unknown';
                }
            })
            ->addColumn('profile_image', function ($user) {
                $imageUrl = $user->profile_image
                    ? htmlspecialchars($user->profile_image_url, ENT_QUOTES, 'UTF-8')
                    : asset('images/default-profile_image.png');

                return '<img src="' . $imageUrl . '"
                        class="rounded-circle user-avatar"
                        width="50"
                        height="50"
                        alt="' . htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8') . '"
                        onerror="this.src=\'' . asset('images/default-profile_image.png') . '\'">';
            })
            ->addColumn('action', function ($user) {
                $viewBtn = '<a href="' . route('users.show', $user->id) . '" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>';
                $editBtn = '<a href="' . route('users.edit', $user->id) . '" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>';
                $deleteBtn = '<button class="btn btn-sm btn-danger delete-user" data-id="' . $user->id . '"><i class="bi bi-trash3"></i></button>';

                return $viewBtn . ' ' . $editBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['status_label', 'profile_image', 'action'])
            ->make(true);
        }

        $roles = Role::all();
        return view('users.crud_user', compact('roles'));
    }

    // ដំណើរការសំណើ ajax របស់ datatable
    public function getData()
    {
        $users = User::select(['id', 'name', 'username', 'email', 'profile_image', 'role_id', 'status']);

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('status_label', function ($user) {
                if ($user->status == 1) {
                    return '<span class="badge bg-success">Active</span>';
                } else {
                    return '<span class="badge bg-danger">Inactive</span>';
                }
            })
            ->addColumn('role', function ($user) {
                switch ($user->role_id) {
                    case 1:
                        return 'Admin';
                    case 2:
                        return 'User';
                    default:
                        return 'Unknown';
                }
            })
            ->addColumn('profile_image', function ($user) {
                $imageUrl = $user->profile_image
                    ? htmlspecialchars($user->profile_image_url, ENT_QUOTES, 'UTF-8')
                    : asset('images/default-profile_image.png');

                return '<img src="' . $imageUrl . '"
                        class="rounded-circle user-avatar"
                        width="50"
                        height="50"
                        alt="' . htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8') . '"
                        onerror="this.src=\'' . asset('images/default-profile_image.png') . '\'">';
            })
            ->addColumn('action', function ($user) {
                $viewBtn = '<a href="' . route('users.show', $user->id) . '" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>';
                $editBtn = '<a href="' . route('users.edit', $user->id) . '" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>';
                $deleteBtn = '<button class="btn btn-sm btn-danger delete-user" data-id="' . $user->id . '"><i class="bi bi-trash3"></i></button>';

                return $viewBtn . ' ' . $editBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['status_label', 'profile_image', 'action'])
            ->make(true);
    }

    // បង្ហាញទម្រង់សម្រាប់បង្កើត user ថ្មី
    public function create()
    {
        return view('users.create');
    }

    // រក្សាទុក user ថ្មី
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role_id' => 'required|integer',
            'status' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $userData = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'status' => $request->status ? 1 : 0, // Convert status to integer (1 for active, 0 for inactive)
        ];

        // គ្រប់គ្រងការផ្ទុក profile_image
        if ($request->hasFile('profile_image')) {

            $extension = $request->file('profile_image')->getClientOriginalExtension();
            $imageName = ''. Str::lower(Str::random(15)) .'_'.uniqid() .'.'.$extension;
            $profile_image = $request->file('profile_image')->storeAs('avatar', $imageName, 'public');
            // Store the file in the public disk under profile_images directory
            // Storage::disk('public')->putFileAs('profile_images', $profile_image, $filename);
            $userData['profile_image'] = 'storage/'. $profile_image;
        }

        User::create($userData);

        return response()->json(['success' => 'User created successfully!']);
    }

    // បង្ហាញព័ត៌មានរបស់ user ជាក់លាក់
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    // បង្ហាញទម្រង់សម្រាប់កែប្រែ user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // ធ្វើបច្ចុប្បន្នភាព user ដែលបានបញ្ជាក់
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role_id' => 'required|integer',
            'status' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $userData = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'status' => $request->status ? 1 : 0, // Convert status to integer (1 for active, 0 for inactive)
        ];

        // ធ្វើបច្ចុប្បន្នភាពពាក្យសម្ងាត់ ប្រសិនបើមាន
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        // គ្រប់គ្រងការផ្ទុក profile_image ប្រសិនបើមាន
        if ($request->hasFile('profile_image')) {
            // លុប profile_image ចាស់ប្រសិនបើមាន
            if ($user->profile_image) {
                Storage::delete('public/profile_images/' . $user->profile_image);
            }

            $extension = $request->file('profile_image')->getClientOriginalExtension();
            $imageName = ''. Str::lower(Str::random(15)) .'_'.uniqid() .'.'.$extension;
            $profile_image = $request->file('profile_image')->storeAs('avatar', $imageName, 'public');
            // Store the file in the public disk under profile_images directory
            // Storage::disk('public')->putFileAs('profile_images', $profile_image, $filename);
            $userData['profile_image'] = 'storage/'. $profile_image;
        }

        $user->update($userData);

        return response()->json(['success' => 'User updated successfully!']);
    }

    // លុប user ដែលបានបញ្ជាក់
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // លុប profile_image ប្រសិនបើមាន
        if ($user->profile_image) {
            Storage::delete('public/profile_images/' . $user->profile_image);
        }

        $user->delete();

        return response()->json(['success' => 'User deleted successfully!']);
    }
}