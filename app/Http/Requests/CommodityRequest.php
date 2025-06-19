<?php

namespace App\Http\Requests;

use App\Enums\CommodityCategoryEnum;
use App\Enums\CommodityEnum;
use App\Enums\MarketTypeEnum;
use App\Models\CommodityCategory;
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
            'name' => 'required|string',
            'category' => 'required|string|in:'.implode(',', CommodityCategory::select('name')->pluck('name')->all()),
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
