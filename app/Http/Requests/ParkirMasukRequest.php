<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ParkirMasukRequest extends FormRequest
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
        return [
            'no_polisi' => ['required', Rule::unique('parkir')->where(fn ($query) => $query->where('status', 0))],
            'merk_kendaraan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'no_polisi.unique' => 'Kendaraan dengan nomor polisi berikut sedang parkir!!',
            'no_polisi.required' => 'Harap isi No Polisi dengan benar!!',
            'merk_kendaraan.required' => 'Harap isi Merk Kendaraan!!',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(redirect()->back()->with('error', $validator->errors()->messages()), 422);
    }
}
