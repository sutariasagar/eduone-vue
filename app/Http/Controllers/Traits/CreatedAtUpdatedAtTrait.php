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
use Carbon\Carbon;
trait CreatedAtUpdatedAtTrait {

	
	public function getCreatedAtAttribute($value)
    {
		return Carbon::createFromTimestamp(strtotime($value))
			->timezone('Asia/Kolkata')
			->format('d/m/Y H:i:s');

        return Carbon::parse($value)->format('d/m/Y H:i:s')->timezone('Asia/Kolkata');
	}

	public function getUpdatedAtAttribute($value)
    {
		return Carbon::createFromTimestamp(strtotime($value))
			->timezone('Asia/Kolkata')
			->format('d/m/Y H:i:s');

        return Carbon::parse($value)->format('d/m/Y H:i:s')->timezone('Asia/Kolkata');
	}
}