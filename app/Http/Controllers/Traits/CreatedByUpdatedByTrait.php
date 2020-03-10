<?php
/**
 * Copyright (c) 2019.
 */

/**
 * Created by PhpStorm.
 * User: keyurshah
 * Date: 24/03/19
 * Time: 4:54 AM
 */

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

trait CreatedByUpdatedByTrait {

	public static function boot()
	{
		parent::boot();
		static::creating(function ($model) {
			if (Auth::user()) {
				if ($createdBy = self::getField('created_by_id')) {
					$model->$createdBy = Auth::user()->id;
				}
				if ($updatedBy = self::getField('updated_by_id')) {
					$model->$updatedBy = Auth::user()->id;
				}
			}
		});

		static::updating(function ($model) {
			if (Auth::user() && $updatedBy = self::getField('updated_by_id')) {
				$model->$updatedBy = Auth::user()->id;
				return true;
			}
		});
	}
	protected static function getField($columnName)
	{
		$field = self::getColumnName($columnName);
		return Schema::hasTable(self::getTableName()) && Schema::hasColumn(self::getTableName(), $field) ? $field : false;
	}
	protected static function getColumnName($columnName)
	{
		return defined('static::'.$columnName) ? constant('static::'.$columnName) : strtolower($columnName);
	}

	public static function getTableName()
	{
		return with(new static)->getTable();
	}
}