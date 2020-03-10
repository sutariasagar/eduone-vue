<?php
/**
 * Copyright (c) 2019.
 */

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Media;
use App\Http\Controllers\Controller;

use App\TempMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;


class MediaController extends Controller
{

	public function store(Request $request)
	{
		$media = new TempMedia();
		$media->save();

		if ($request->hasFile('file')) {
			$media->addMedia($request->file('file'))->toMediaCollection('file');
		}

		return (new Media($media))
			->response()
			->setStatusCode(201);
	}
}
