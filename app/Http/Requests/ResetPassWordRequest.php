<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassWordRequest extends FormRequest
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
        return [
                    'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:255',
                    'password' => 'required|min:8',
                    'token'=>'required',

        ];
    }
     public function messages()
    {
        return [

  
            'email.required' => "The email is required *",
            'email.email' => "The email format must be example@mail.com",
            'email.max'=> 'The email is too long',
            'password.required'=> 'The password is required *',
            'password.min' => 'The password should be at least 8 charachters',
            'token.required'=>'The Pin Code is required *',
            
        ];
    }

    public $validator = null;

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->validator = $validator;
    }
    

}
