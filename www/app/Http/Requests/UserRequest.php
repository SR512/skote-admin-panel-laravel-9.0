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
        $routes = ['users.edit','users.update'];
        //Store rules
        $rules = [
            'role' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ];

        if (in_array(request()->route()->getName(),$routes)) {
            //Update rules
            $rules['password'] = 'nullable|string|min:8|confirmed';
            $rules['email'] = 'nullable|email|max:255';
        }
        return $rules;
    }
}
