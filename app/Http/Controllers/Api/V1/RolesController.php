<?php

namespace App\Http\Controllers\Api\V1;

use App\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\Role as RoleResource;
use App\Http\Requests\Admin\StoreRolesRequest;
use App\Http\Requests\Admin\UpdateRolesRequest;
use Carbon\Carbon;
use Freshbitsweb\Laratables\Laratables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;


class RolesController extends Controller
{
    public function index(Request $request)
    {
        if (Gate::denies('role_access') && Gate::denies('user_access')) {
            return abort(401);
        }

        if($request->isXmlHttpRequest()){
	        $query = Role::with('permission','created_by','updated_by')->select('roles.*');

	        return DataTables::of($query)
                ->addColumn('permission', function(Role $role){
                    return $role->permission->map(function($permission) {
                        return "<span 'btn btn-sm'>".$permission->title.'</span>';
                    })->implode(' ');
                })
                ->addColumn('created_by', function(Role $model){
                    return $model->created_by ? $model->created_by->name : ''  ;
                })
                ->addColumn('updated_by', function(Role $model){
                    return $model->updated_by ? $model->updated_by->name : ''  ;
                })
                ->make(true);
        }else{
	        return new RoleResource(Role::with(['permission'])->get());
        }

    }

    public function show($id)
    {
        if (Gate::denies('role_view')) {
            return abort(401);
        }

        $role = Role::with(['permission', 'created_by', 'updated_by'])->findOrFail($id);

        return new RoleResource($role);
    }

    public function store(StoreRolesRequest $request)
    {
        if (Gate::denies('role_create')) {
            return abort(401);
        }

        $role = Role::create($request->all());
        $role->permission()->sync($request->input('permission', []));
        

        return (new RoleResource($role))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateRolesRequest $request, $id)
    {
        if (Gate::denies('role_edit')) {
            return abort(401);
        }

        $role = Role::findOrFail($id);
        $role->update($request->all());

        $role->permission()->sync($request->input('permission', []));

        $updateRole = Role::findOrFail($id);
        $updateRole->updated_by_id = Auth::user()->id;
	    $updateRole->updated_at = Carbon::now();
	    $updateRole->save();
        

        return (new RoleResource($role))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('role_delete')) {
            return abort(401);
        }

        $role = Role::findOrFail($id);
        $role->delete();

        return response(null, 204);
    }
}
