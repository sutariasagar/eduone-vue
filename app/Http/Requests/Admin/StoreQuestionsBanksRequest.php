<?php
namespace App\Http\Requests\Admin;

use App\QuestionsBank;
use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionsBanksRequest extends FormRequest
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
        return QuestionsBank::storeValidation($this);
    }
}
