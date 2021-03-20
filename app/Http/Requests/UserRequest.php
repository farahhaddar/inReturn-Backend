<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                {
                    return [
                        'name' => 'required|max:255',
                        'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:users|max:255',
                        'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'password' => 'required|min:8',
                        'phoneNb' => 'required|numeric|unique:users',
                        'address' => 'required|max:255',
                        'extraInfo' => 'max:255',
                        'city_id' => 'required',
                    ];
                }
            case 'PUT':
                {

                    return [

                        'name' => 'required|max:255',
                        'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:255',
                        'image' => 'Nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'password' => 'min:8|Nullable',
                        'phoneNb' => 'required|numeric',
                        'address' => 'required|max:255',
                        'extraInfo' => 'max:255',
                        'city_id' => 'required',

                    ];
                }
        }
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [

            'name.required' => 'Name is required *',
            'name.max' => 'Name is too long',
            'image.required' => ' Image is required *',
            'image.max' => 'Image is too larage',
            'image.mimes' => 'Image type is unacceptable',
            'email.required' => "The email is required *",
            'email.email' => "The email format must be eaxmple@mail.com",
            'email.unique' => 'This email is already taken ',
            'email.max' => 'The email is too long',
            'password.required' => 'The password is required *',
            'password.min' => 'the password should be at least 8 charachters',
            'phoneNb.required' => "the phone number is required *",
            'phoneNb.numeric' => "the phone number should be numric *",
            "address.required" => "The Adress feild is required *",
            'address.max' => 'The adress is too long',
            'exraInfo.max' => 'The adress extra Info is too long',
            'city_id.required' => "The city is reuired",

        ];
    }

    public $validator = null;

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->validator = $validator;
    }

}
