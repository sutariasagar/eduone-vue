<?php
namespace App\Http\Requests\Admin;

use App\Exam;
use Illuminate\Foundation\Http\FormRequest;

class UpdateExamsRequest extends FormRequest
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
        return Exam::updateValidation($this);
    }
}
