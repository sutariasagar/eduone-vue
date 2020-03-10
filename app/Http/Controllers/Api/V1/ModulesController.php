<?php

namespace App\Http\Controllers\Api\V1;

use App\Module;
use App\Http\Controllers\Controller;
use App\Http\Resources\Module as ModuleResource;
use App\Http\Requests\Admin\StoreModulesRequest;
use App\Http\Requests\Admin\UpdateModulesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;


class ModulesController extends Controller
{
    public function index()
    {
        if (Gate::denies('module_access')) {
		    return abort(401);
        }

	    $query = Module::with(['created_by', 'updated_by'])->select('modules.*');

	    return DataTables::of($query)
            ->addColumn('created_by', function(Module $module){
                return $module->created_by ? $module->created_by->name : ''  ;
            })
            ->addColumn('updated_by', function(Module $module){
                return $module->updated_by ? $module->updated_by->name : ''  ;
            })
            ->make(true);

    }

    public function show($id)
    {
        if (Gate::denies('module_view')) {
            return abort(401);
        }

        $module = Module::with(['created_by', 'updated_by'])->findOrFail($id);

        return new ModuleResource($module);
    }

    public function store(StoreModulesRequest $request)
    {
        if (Gate::denies('module_create')) {
            return abort(401);
        }

        $module = Module::create($request->all());
        
        

        return (new ModuleResource($module))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateModulesRequest $request, $id)
    {
        if (Gate::denies('module_edit')) {
            return abort(401);
        }

        $module = Module::findOrFail($id);
        $module->update($request->all());
        
        
        

        return (new ModuleResource($module))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('module_delete')) {
            return abort(401);
        }

        $module = Module::findOrFail($id);
        $module->delete();

        return response(null, 204);
    }
}
