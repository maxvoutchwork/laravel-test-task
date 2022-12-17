<?php

namespace App\Http\Requests;

use App\Models\Position;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => 'required|min:2|max:256',
            "date_of_employment" => 'required|date_format:j.m.Y|before_or_equal:now',
            "phone_number" => 'required|regex:/^((\+380[\s])\(\d{2}\)([\s]\d{3}[\s]\d{2}[\s]\d{2}))$/|unique:employees',
            "email" => 'required|email|unique:employees',
            "salary" => 'required|numeric|between:0,500.000',
            "photo" => 'required',
            "position_id" => 'required|exists:App\Models\Position,id',
            "employee_id" => "exists:App\Models\Employee,id",
            "created_at" => 'date_format:"d.m.Y"|before_or_equal:now',
            "admin_created_id" => 'exists:App\Models\User,id',
        ];
    }
}
