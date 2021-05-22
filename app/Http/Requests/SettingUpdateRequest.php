<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
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
            //
            'amountOfReservations' => 'required',
            'timeslot' => 'required',
            'startdate' => 'nullable',
            'enddate' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'amountOfReservations' => 'Je moet een getal invullen.',
            'timeslot' => 'Er moet een tijd staan in minuten',
        ];
    }
}
