<?php
/**
 * Copyright (c) 2019.
 */

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\QuestionsBank;
use function config;
use Conner\Tagging\Model\Tagged;
use function sizeof;
use Spatie\Tags\Tag;
use Symfony\Component\VarDumper\Cloner\Data;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class ConfigController extends Controller
{
	public function materialTypes()
	{

		$materialTypes = config('materialtypes');

		return $materialTypes;
	}

	public function questionPools()
	{

		$materialTypes = config('questionpools');

		return $materialTypes;
	}

	public function sections()
	{

		$sections = config('sections');

		return $sections;
	}

	public function tags(Request $request){

		if($request->has('type')){
			if($request->input('type') == 'questions'){
				$tags = Tagged::select('tag_name','tag_slug')->where('taggable_type','=',QuestionsBank::class)->groupBy(array('tag_slug','tag_name'))->get();
				if(sizeof($tags) == 0){
					$tags = array(0=>array('tag_name'=>'','tag_slug'=>''));
				}
			}else{
				$tags = Tagged::all();
			}
		}else{
			$tags = Tagged::all();
		}
		return array('data'=>$tags);
	}

}
