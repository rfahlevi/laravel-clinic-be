<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;


class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            "name" => "required",
            "email" => "required|email|unique:users,name,",
            "password" => "required|min:5",
            "role" => "required"
        ];

        if($this->method() === 'PUT')
        {
            $userId = $this->route('user')->id;
            $rules["email"]  = "required|email|unique:users,name,".$userId;
        }

        return $rules;
    }

    public function messages(): array
    {
        return  [
            "name.required" => "Nama user tidak boleh kosong",
            "email.required" => "Email tidak boleh kosong",
            "email.email" => "Format email tidak sesuai",
            "email.unique" => "Email sudah terdaftar",
            "password.required" => "Password tidak boleh kosong",
            "password.min" => "Password minimal 5 karakter",
            "role.required" => "Role tidak boleh kosong"
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $formattedError = "";
        foreach ($errors->keys() as $field)
        {
            $formattedError = $errors->first($field);
        }

        throw new HttpResponseException(
            redirect()->route('user.create')->with([
                "type_menu" => "user",
                "error" => $formattedError
            ])
        );
    }
}
