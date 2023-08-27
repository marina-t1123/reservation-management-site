<?php

namespace App\Http\Requests\ReservationController;

use Illuminate\Foundation\Http\FormRequest;

class ChangeMemoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'memo' => ['string', 'max:1000'],
        ];
    }
}
