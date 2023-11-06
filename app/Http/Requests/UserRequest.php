<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
    public function rules(): array
    {
        $rules = [
            'name' => 'required',
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required',
            'confirm_password'=> 'required|same:password',
            'university_id' => [
                'nullable',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('university_id', '!=', null);
                }),
            ],
        ];

        // Kiểm tra nếu yêu cầu là update, loại bỏ rule unique khi university_id là null
        if ($this->isMethod('patch')) {
            $rules['university_id'] = 'nullable';
        }

        return $rules;
    }

    public function messages() {
        return [
            'name.required' => 'Không được để trống họ tên',
            'email.required'=> 'Không được để trống email',
            'email.email'=> 'Không phải email',
            'email.unique'=> 'Email đã tồn tại',
            'password.required'=> 'Không được để trống mật khẩu',
            'confirm_password.required'=> 'Không được để trống nhập lại mật khẩu',
            'confirm_password.same'=> 'Mật khẩu không khớp',
            'university_id.unique'=> 'Trường đại học này đã tồn tại admin',
        ];
    }
    
}
