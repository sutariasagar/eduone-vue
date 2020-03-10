<?php

namespace App\Http\Controllers\Api\V1;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use Freshbitsweb\Laratables\Laratables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{
    public function index(Request $request)
    {
        if (Gate::denies('user_access')) {
            return abort(401);
        }

        $query = User::with(['role'])->select('users.*');
        
	    return DataTables::of($query)
			    // ->addColumn('created_by', function(User $model){
				//     return $model->created_by ? $model->created_by->name : ''  ;
			    // })
			    // ->addColumn('updated_by', function(User $model){
				//     return $model->updated_by ? $model->updated_by->name : ''  ;
			    // })
			    ->make(true);
    }

    public function show($id)
    {
        if (Gate::denies('user_view')) {
            return abort(401);
        }

        $user = User::with(['role','created_by', 'updated_by'])->findOrFail($id);

        return new UserResource($user);
    }

    public function store(StoreUsersRequest $request)
    {
        if (Gate::denies('user_create')) {
            return abort(401);
        }

        $user = User::create($request->all());
        $user->role()->sync($request->input('role', []));
        

        return (new UserResource($user))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateUsersRequest $request, $id)
    {
        if (Gate::denies('user_edit')) {
            return abort(401);
        }

        $user = User::findOrFail($id);
        $user->update($request->all());
        $user->role()->sync($request->input('role', []));
        
        

        return (new UserResource($user))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('user_delete')) {
            return abort(401);
        }

        $user = User::findOrFail($id);
        $user->delete();

        return response(null, 204);
    }

    public function me(){
        $user = Auth::user();
        return (new UserResource($user))
            ->response()
            ->setStatusCode(200);
    }
}
