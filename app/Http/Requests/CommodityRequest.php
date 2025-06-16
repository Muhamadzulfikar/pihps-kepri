<?php

namespace App\Http\Requests;

use App\Enums\CommodityCategoryEnum;
use App\Enums\CommodityEnum;
use App\Enums\MarketTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class CommodityRequest extends FormRequest
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
            'name' => 'required|string|in:'.implode(',', CommodityEnum::toValues()),
            'category' => 'required|string|in:'.implode(',', CommodityCategoryEnum::toValues()),
            'market_type' => 'required|string|in:'.implode(',', MarketTypeEnum::toValues())
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
