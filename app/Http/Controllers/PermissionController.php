<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    //
    public function index(){
        return view('admin.permissions.index',[
            'permissions'=> Permission::all()

        ]);
    }
    public function store(){
        request()->validate([
            'name'=> ['required']
        ]);
        Permission::create([
            'name'=> Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')
        ]);
        return back();
    }
    public function edit(Permission $permission){
        return view('admin.permissions.edit', [
            'permission'=>$permission,
        ]);
        //return view('admin.permissions.edit', ['permission']);
    }
    public function update(Permission $permission){
        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::lower(request('name'));
        if($permission->isDirty('name')){
            session()->flash('permission-updated', 'Updated Permission '. $permission->name);
            $permission->save();
        }
        else{
            session()->flash('permission-updated', 'Nothing to update');
            
        }
        
        
        return back();

    }
    public function destroy(Permission $permission){
        $permission->delete();
        session()->flash('permission-deleted', 'Deleted Permission '. $permission->name);
        return back();
    }
}
