<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class EducationRequest extends FormRequest
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

        $board_name = [
            'Agriculture and Forestry University, Chitwan',
            'Far-western University, Kanchanpur',
            'Kathmandu University, Dhulikhel',
            'Mid Western University, Birendranagar',
            'Nepal Open University, Lalitpur',
            'Pokhara University, Pokhara',
            'Purbanchal University, Biratnagar',
            'Tribhuvan University, Kirtipur',
            'HSEB/NEB',
            'Other'
        ];
        return [
             'your_degree' => ['required', Rule::in(['SLC/SEE','+2/PCL','Bachelors','Master','PhD','MPhil'])],
            'board_name' => ['required', 'string', Rule::in($board_name)],
            'major_subject' => 'required',
            'academic_year' => 'required',
            'division_grade' => 'required|string',
            'complete_years' => 'required|string',
        ];
    }
}
