<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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

        $districts = [
            'Bhojpur','Dhankuta','Ilam','Jhapa','Khotang','Morang','Okhaldhunga','Panchthar','Sankhuwasabha','Solukhumbu','Sunsari','Taplejung','Terhathum','Udayapur',
            'Bara','Dhanusha','Mahottari','Parasi','Parsa','Rautahat','Saptari','Sarlahi','Siraha',
            'Bhaktapur','Chitwan','Dhading','Dolakha','Kathmandu','Kavrepalanchok','Lalitpur','Makwanpur','Nuwakot','Ramechhap','Rasuwa','Sindhuli','Sindhupalchok',
            'Baglung','Gorkha','Kaski','Lamjung','Manang','Mustang','Myagdi','Parbat','Syangja','Tanahun',
            'Arghakhanchi','Banke','Bardiya','Dang','Gulmi','Kapilvastu','Nawalparasi East','Palpa','Pyuthan','Rolpa','Rukum East','Rupandehi',
            'Dailekh','Dolpa','Humla','Jajarkot','Jumla','Kalikot','Mugu','Rukum West','Salyan','Surkhet',
            'Achham','Baitadi','Bajhang','Bajura','Darchula','Dadeldhura','Doti','Kailali','Kanchanpur'
        ];
        return [
            'citizenship_no' => 'required|numeric',
            'citizenship_copy' => 'required|image|mimes:jpg,jpeg,png,gif|max:300',

            'district' => ['required', 'string', 'in:' . implode(',', $districts)],
            'permanent_address' => 'required|string|max:500',
            'contact_address' => 'required|string|max:500',

            'contact_landline' => 'nullable|string|regex:/^[0-9+\-\s]{6,15}$/',
            'contact_phone' => 'required|string|regex:/^\+?[0-9\s\-]{10,15}$/',
        ];
    }
}