<?php

namespace App\Http\Requests;

use App\Enums\CityEnum;
use App\Enums\MarketEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'city_market_id' => [
                'required',
                'exists:city_markets,id',
                Rule::unique('markets')
                    ->where('city_market_id', request()->city_market_id)
                    ->where('start_date', request()->start_date)
                    ->ignore(request()->id, 'id'),
            ],
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
