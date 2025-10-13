<?php

namespace App\Http\Requests;
use App\Rules\DevText;
use Illuminate\Foundation\Http\FormRequest;
use PhpParser\Node\Expr\FuncCall;

class PersonalRequest extends FormRequest
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
        return [
            'student_photo' => 'required|image|mimes:jpg,jpeg,png,gif|max:300',
            'student_signature' => 'required|image|mimes:jpg,jpeg,png,gif|max:300',

            'first_name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'middle_name' => 'nullable|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'required|regex:/^[a-zA-Z\s]+$/',

            'first_name_dev' => ['required', new DevText],
            'middle_name_dev' => ['nullable', new DevText],
            'last_name_dev' => ['required', new DevText],

            'father_name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'mother_name' => 'required|regex:/^[a-zA-Z\s]+$/',

            'gender' => 'required|in:Male,female,Other',
            'marital_status' => 'required|in:Married, Unmarried',

            'date_of_birth_bs' => 'required|regex:/^[\x{0966}-\x{096F}\-\/]+$/u',
            'date_of_birth_ad' => 'required|date_format:m/d/Y',
        ];
    }

    public function messages(): array
    {
        return [
            'student_photo.required' => 'student photo is required',
            'student_photo.mimes' => 'student photo must be jpg, png, jepg, gif',
            'student_photo.max' => 'student photo must be 300kb',

            'student_signature.required' => 'student signature is required',
            'student_signature.mimes' => 'student photo must be jpg, png, jepg, gif',
            'student_signature.max' => 'student signature must be 300kb',

            'first_name.required' => 'first name is required',
            'first_name.regex' => 'first name must contain letter and space',

            'middle_name.nullable' => 'middlename is optional',
            'middle_name.regex' => 'the middle name must contain only letter and space',

            'last_name.required' => 'first name is required',
            'last_name.regex' => 'first name must contain only letter and space',

            'first_name_dev' => 'first name is required',
            'middle_name_dev' => 'middle name is optional',

            'father_name.required' => 'Father name is required.',
            'father_name.regex' => 'Father name must contain only letters and spaces.',

            'mother_name.required' => 'Mother name is required.',
            'mother_name.regex' => 'Mother name must contain only letters and spaces.',

            'gender.required' => 'Gender is required.',
            'gender.in' => 'Gender must be Male, Female or Other',

            'marital_status.required' => 'Marital status is required.',
            'marital_status.in' => 'Marital status must be Married or Unmarried.',

            'date_of_birth_bs.required' => 'Date of birth (BS) is required.',
            'date_of_birth_bs.regex' => 'Date of birth (BS) must be in Nepali numerals format.',

            'date_of_birth_ad.required' => 'Date of birth (AD) is required.',
            'date_of_birth_ad.date_format' => 'Date of birth (AD) must be in the format mm/dd/yyyy.',

        ];
    }
}
