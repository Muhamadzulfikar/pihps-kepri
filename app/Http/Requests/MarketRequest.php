<?php

namespace App\Http\Requests;

use App\Enums\CityEnum;
use App\Enums\MarketEnum;
use Illuminate\Foundation\Http\FormRequest;

class MarketRequest extends FormRequest
{
     /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'commodity_uuid' => 'required|exists:commodities,uuid',
            'name' => 'required|string|in:'.implode(',', MarketEnum::toValues()),
            'city' => 'required|string|in:'.implode(',', CityEnum::toValues()),
            'price' => 'required|numeric',
            'start_date' => 'required|date',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
