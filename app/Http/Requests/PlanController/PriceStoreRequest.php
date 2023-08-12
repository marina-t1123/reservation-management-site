<?php

namespace App\Http\Requests\PlanController;

use Illuminate\Foundation\Http\FormRequest;

class PriceStoreRequest extends FormRequest
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
            'title' => ['string', 'max:255'],
            'explanation' => ['string', 'max:1500'],
            'reservation_slot_id' => ['required', 'integer','exists:reservation_slots,id'],
            'date' => ['required', 'date'],
            'price' => ['required', 'integer', 'min:0'],
        ];
    }
}
