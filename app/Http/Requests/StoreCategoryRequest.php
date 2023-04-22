<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "title" => ["required", "max:30", Rule::unique('categories', 'title')
            ->where(fn($query) => $query->where('user_id', auth()->user()->id))],
            "type" => Rule::in(['expense', 'income']),
            "color" => "required",
            "icon" => "required",
        ];
    }

    /**
     * Get custom validation messages
     *
     * @return array<string, mixed>
     */
    public function messages(){
        return [
            "type.in" => "O campo tipo deve ser receita ou despesa",
        ];
    }
}
