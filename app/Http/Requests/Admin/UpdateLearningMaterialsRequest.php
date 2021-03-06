<?php
namespace App\Http\Requests\Admin;

use App\LearningMaterial;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLearningMaterialsRequest extends FormRequest
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
        return LearningMaterial::updateValidation($this);
    }
}
