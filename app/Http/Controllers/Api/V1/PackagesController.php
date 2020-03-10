<?php

namespace App\Http\Controllers\Api\V1;

use App\Package;
use App\Http\Controllers\Controller;
use App\Http\Resources\Package as PackageResource;
use App\Http\Requests\Admin\StorePackagesRequest;
use App\Http\Requests\Admin\UpdatePackagesRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;



class PackagesController extends Controller
{
    public function index()
    {
        if (Gate::denies('package_access')) {
		    return abort(401);
	    }

        $query = Package::with(['created_by', 'updated_by'])->select('packages.*');
        
        return DataTables::of($query)
	        ->addColumn('created_by', function(Package $package){
		        return $package->created_by ? $package->created_by->name : ''  ;
	        })
	        ->addColumn('updated_by', function(Package $package){
		        return $package->updated_by ? $package->updated_by->name : ''  ;
	        })->make(true);
        
    }

    public function show($id)
    {
        if (Gate::denies('package_view')) {
            return abort(401);
        }

        $package = Package::with(['created_by', 'updated_by'])->findOrFail($id);

        return new PackageResource($package);
    }

    public function store(StorePackagesRequest $request)
    {
        if (Gate::denies('package_create')) {
            return abort(401);
        }

        $package = Package::create($request->all());
        
        

        return (new PackageResource($package))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdatePackagesRequest $request, $id)
    {
        if (Gate::denies('package_edit')) {
            return abort(401);
        }

        $package = Package::findOrFail($id);
        $package->update($request->all());


        return (new PackageResource($package))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('package_delete')) {
            return abort(401);
        }

        $package = Package::findOrFail($id);
        $package->delete();

        return response(null, 204);
    }
}
