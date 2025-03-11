<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        // Uncomment and adjust the middleware as needed for your permissions
        // $this->middleware('permission:view permission', ['only' => ['index']]);
        // $this->middleware('permission:create permission', ['only' => ['create','store']]);
        // $this->middleware('permission:update permission', ['only' => ['update','edit']]);
        // $this->middleware('permission:delete permission', ['only' => ['destroy']]);
    }

    public function index(Request $request): View
    {
        $permissions = Permission::orderBy('created_at', 'desc')->paginate(10);
        return view('permissions.index', compact('permissions'));
    }

    public function create(): View
    {
        // return view('permissions.create');
        $permissions = Permission::all();
        return view('permissions.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]
        ]);

        Permission::create([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status', 'Permission Created Successfully');
    }

    public function edit(Permission $permission): View
    {
        return view('permissions.edit', ['permission' => $permission]);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,' . $permission->id
            ]
        ]);

        $permission->update([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status', 'Permission Updated Successfully');
    }
    public function show($id): View
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return abort(404, 'Permission not found');
        }

        return view('permissions.show', compact('permission'));
    }

    public function destroy($permissionId)
    {
        $permission = Permission::find($permissionId);
        if ($permission) {
            $permission->delete();
            return redirect('permissions')->with('status', 'Permission Deleted Successfully');
        }

        return redirect('permissions')->with('error', 'Permission Not Found');
    }

    
}
