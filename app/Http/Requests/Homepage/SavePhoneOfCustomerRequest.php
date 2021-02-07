<?php

namespace App\Http\Requests\Homepage;

use Illuminate\Foundation\Http\FormRequest;

class SavePhoneOfCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => 'required|max:25',
            'one_signal_user_id' => 'required'
        ];
    }
}
