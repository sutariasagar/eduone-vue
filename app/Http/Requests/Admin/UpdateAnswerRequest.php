<?php
/**
 * Copyright (c) 2019.
 */

namespace App\Http\Requests\Admin;

use App\Answer;
use App\AnswersType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAnswerRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return Answer::updateValidation($this);
	}
}
