<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class RoleController extends Controller
{
    //
    public function index(){
        return view('admin.roles.index', [
            'roles'=> Role::all()
        ]);
    }
    public function store(){
        request()->validate([
            'name'=> ['required']
        ]);
        Role::create([
            'name'=> Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lowerlower(request('name')))->slug('-')
        ]);
        return back();
    }
    public function edit(Role $role){
        return view('admin.roles.edit', [
            'role'=>$role,
            'permissions' => Permission::all()
        ]);
    }
    public function update(Role $role){
        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::lower(request('name'));
        if($role->isDirty('name')){
            session()->flash('role-updated', 'Updated Role '. $role->name);
            $role->save();
        }
        else{
            session()->flash('role-updated', 'Nothing to update');
            
        }
        
        
        return back();

    }
    public function attach_permission(Role $role){
        $role->permissions()->attach(request('permission'));
        return back();
    }
    public function detach_permission(Role $role){
        $role->permissions()->detach(request('permission'));
        return back();
    }
    public function destroy(Role $role){
        $role->delete();
        session()->flash('role-deleted', 'Deleted Role '. $role->name);
        return back();
    }
}
