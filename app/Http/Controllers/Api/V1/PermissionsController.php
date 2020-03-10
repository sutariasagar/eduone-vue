<?php

namespace App\Http\Controllers\Api\V1;

use App\Permission;
use App\Http\Controllers\Controller;
use App\Http\Resources\Permission as PermissionResource;
use App\Http\Requests\Admin\StorePermissionsRequest;
use App\Http\Requests\Admin\UpdatePermissionsRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;



class PermissionsController extends Controller
{
    public function index()
    {
        if (Gate::denies('permission_access') && Gate::denies('role_access')) {
            return abort(401);
        }

        $query = Permission::with(['created_by','updated_by'])->select('permissions.*');


	    return DataTables::of($query)
		    ->addColumn('created_by', function(Permission $model){
			    return $model->created_by ? $model->created_by->name : ''  ;
		    })
		    ->addColumn('updated_by', function(Permission $model){
			    return $model->updated_by ? $model->updated_by->name : ''  ;
		    })
	                     ->make(true);
    }

    public function show($id)
    {
        if (Gate::denies('permission_view')) {
            return abort(401);
        }

        $permission = Permission::with(['created_by', 'updated_by'])->findOrFail($id);

        return new PermissionResource($permission);
    }

    public function store(StorePermissionsRequest $request)
    {
        if (Gate::denies('permission_create')) {
            return abort(401);
        }

        $permission = Permission::create($request->all());
        
        

        return (new PermissionResource($permission))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdatePermissionsRequest $request, $id)
    {
        if (Gate::denies('permission_edit')) {
            return abort(401);
        }

        $permission = Permission::findOrFail($id);
        $permission->update($request->all());
        
        
        

        return (new PermissionResource($permission))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('permission_delete')) {
            return abort(401);
        }

        $permission = Permission::findOrFail($id);
        $permission->delete();

        return response(null, 204);
    }
}
