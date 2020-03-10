<?php

namespace App\Http\Controllers\Api\V1;

use App\ExamSectionSubjectMapping;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExamSectionSubjectMapping as ExamSectionSubjectMappingResource;
use App\Http\Requests\Admin\StoreExamSectionSubjectMappingsRequest;
use App\Http\Requests\Admin\UpdateExamSectionSubjectMappingsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;


class ExamSectionSubjectMappingsController extends Controller
{
    public function index(Request $request)
    {
	    $query = ExamSectionSubjectMapping::with(['subject','chapter','topic','subtopic'])->select('exam_section_subject_mappings.*');

        if($request->exists('exam_section_id')){
            $query->where('exam_section_id','=',$request->input('exam_section_id'));
        }
	    return DataTables::of($query)
	                     ->addColumn('subject', function(ExamSectionSubjectMapping $exam_exam_mapping){
		                     return $exam_exam_mapping->subject ? $exam_exam_mapping->subject->title : '';
	                     })
	                     ->addColumn('chapter', function(ExamSectionSubjectMapping $exam_exam_mapping){
		                     return $exam_exam_mapping->chapter ? $exam_exam_mapping->chapter->title : '';
	                     })
	                     ->addColumn('topic', function(ExamSectionSubjectMapping $exam_exam_mapping){
		                     return $exam_exam_mapping->topic ? $exam_exam_mapping->topic->title : '';
	                     })
	                     ->addColumn('subtopic', function(ExamSectionSubjectMapping $exam_exam_mapping){
		                     return $exam_exam_mapping->subtopic ? $exam_exam_mapping->subtopic->title : '';
	                     })

	                     ->make(true);
    }

    public function show($id)
    {
//        if (Gate::denies('exam_section_subject_mapping_view')) {
//            return abort(401);
//        }

        $exam_section_subject_mapping = ExamSectionSubjectMapping::with(['exam_section','subject','chapter','topic','subtopic'])->findOrFail($id);

        return new ExamSectionSubjectMappingResource($exam_section_subject_mapping);
    }

    public function store(StoreExamSectionSubjectMappingsRequest $request)
    {
        // if (Gate::denies('exam_section_subject_mapping_create')) {
        //     return abort(401);
        // }

        $exam_section_subject_mapping = ExamSectionSubjectMapping::create($request->all());
        
        

        return (new ExamSectionSubjectMappingResource($exam_section_subject_mapping))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateExamSectionSubjectMappingsRequest $request, $id)
    {
//        if (Gate::denies('exam_section_subject_mapping_edit')) {
//            return abort(401);
//        }

        $exam_section_subject_mapping = ExamSectionSubjectMapping::with(['exam_section','subject','chapter','topic','subtopic'])->findOrFail($id);
        $exam_section_subject_mapping->update($request->all());
        
        
        

        return (new ExamSectionSubjectMappingResource($exam_section_subject_mapping))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
//        if (Gate::denies('exam_section_subject_mappings_delete')) {
//            return abort(401);
//        }

        $exam_section_subject_mapping = ExamSectionSubjectMapping::findOrFail($id);
        $exam_section_subject_mapping->delete();

        return response(null, 204);
    }
}
