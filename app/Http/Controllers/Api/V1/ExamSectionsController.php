<?php

namespace App\Http\Controllers\Api\V1;

use App\ExamSection;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExamSection as ExamSectionResource;
use App\Http\Requests\Admin\StoreExamSectionsRequest;
use App\Http\Requests\Admin\UpdateExamSectionsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;



class ExamSectionsController extends Controller
{
    public function index()
    {
        

        return new ExamSectionResource(ExamSection::with([])->get());
    }

    public function show($id)
    {
        if (Gate::denies('exam_section_view')) {
            return abort(401);
        }

        $exam_section = ExamSection::with([])->findOrFail($id);

        return new ExamSectionResource($exam_section);
    }

    public function store(StoreExamSectionsRequest $request)
    {
//        if (Gate::denies('exam_section_create')) {
//            return abort(401);
//        }

        $exam_section = ExamSection::create($request->all());
        
        

        return (new ExamSectionResource($exam_section))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateExamSectionsRequest $request, $id)
    {
//        if (Gate::denies('exam_section_edit')) {
//            return abort(401);
//        }

        $exam_section = ExamSection::findOrFail($id);
        $exam_section->update($request->all());


        return (new ExamSectionResource($exam_section))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('exam_section_delete')) {
            return abort(401);
        }

        $exam_section = ExamSection::findOrFail($id);
        $exam_section->delete();

        return response(null, 204);
    }
}
