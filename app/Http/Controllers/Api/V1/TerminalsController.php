<?php

namespace App\Http\Controllers\Api\V1;

use App\Terminal;
use App\Http\Controllers\Controller;
use App\Http\Resources\Terminal as TerminalResource;
use App\Http\Requests\Admin\StoreTerminalsRequest;
use App\Http\Requests\Admin\UpdateTerminalsRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;



class TerminalsController extends Controller
{
    public function index()
    {
        if (Gate::denies('terminal_access')) {
		    return abort(401);
        }
        
        $query = Terminal::with('user','created_by','updated_by')->select('terminals.*');

        return DataTables::of($query)
	        ->addColumn('created_by', function(Terminal $model){
		        return $model->created_by ? $model->created_by->name : ''  ;
	        })
	        ->addColumn('updated_by', function(Terminal $model){
		        return $model->updated_by ? $model->updated_by->name : ''  ;
            })
            ->addColumn('user', function(Terminal $model){
		        return $model->user ? $model->user->name : '';
            })
            ->make(true);

    }

    public function show($id)
    {
        if (Gate::denies('terminal_view')) {
            return abort(401);
        }

        $terminal = Terminal::with(['user','created_by', 'updated_by'])->findOrFail($id);

        return new TerminalResource($terminal);
    }

    public function store(StoreTerminalsRequest $request)
    {
        if (Gate::denies('terminal_create')) {
            return abort(401);
        }

        $terminal = Terminal::create($request->all());
        
        

        return (new TerminalResource($terminal))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateTerminalsRequest $request, $id)
    {
        if (Gate::denies('terminal_edit')) {
            return abort(401);
        }

        $terminal = Terminal::findOrFail($id);
        $terminal->update($request->all());
        
        
        

        return (new TerminalResource($terminal))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('terminal_delete')) {
            return abort(401);
        }

        $terminal = Terminal::findOrFail($id);
        $terminal->delete();

        return response(null, 204);
    }
}
