<?php
/**
 * Copyright (c) 2019.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;


class TempMedia extends Model implements HasMedia
{
	use SoftDeletes, HasMediaTrait;

	protected $appends = ['file', 'file_link', 'uploaded_file', 'file_link_url'];
	protected $with = ['media'];

	public function getFileAttribute()
	{
		return [];
	}

	public function getUploadedFileAttribute()
	{
		return $this->getMedia('file')->keyBy('id');
	}

	/**
	 * @return string
	 */
	public function getFileLinkAttribute()
	{
		$file = $this->getMedia('file');
		if (!count($file)) {
			return null;
		}
		$html = [];
		foreach ($file as $file) {
			$html[] = '<a href="' . $file->getUrl() . '" target="_blank">' . $file->file_name . '</a>';
		}

		return implode('<br/>', $html);
	}

	public function getFileLinkUrlAttribute()
	{
		$file = $this->getMedia('file');
		if (!count($file)) {
			return null;
		}
		$html = [];
		foreach ($file as $file) {
			$html[] = $file->getUrl();
		}
		return $html;
	}
}
