<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationStoreRequest extends FormRequest
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
            'userId' => 'required',
            'date' => 'required',
            'starttime' => 'required',
            'endtime' => 'required',
            'courts_id' => 'required',
            'users' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'userId.required' => 'De gebruiker id is veplicht.',
            'date.required' => 'Er is geen datum geselecteerd.',
            'starttime.required' => 'Er is geen starttijd geselecteerd.',
            'endtime.required' => 'Er is geen eindtijd geselecteerd.',
            'courts_id' => 'Er is geen baan geselecteerd.',
            'users.required' => 'Selecteer minimaal 1 medespeler.',
        ];
    }
}
