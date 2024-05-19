<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {

        if (in_array($this->method(), ['PUT', "PATCH"])) {
            return [
                'email' => ['required', 'email', 'string', 'unique:users,email,' . $request->user . 'max:255'], 
                'password' => ['nullable', 'string', 'min:6', 'confirmed', 'max:255'],
                'role' => ['required', 'in:1,2,3'],
            ];   
        } else {
            return [
                'email' => ['required', 'email', 'string', 'unique:users,email', 'max:255'],
                'password' => ['required', 'string', 'min:6', 'confirmed', 'max:255'],
                'role' => ['required', 'in:1,2,3'],
            ];   
        }
        
    }
}
