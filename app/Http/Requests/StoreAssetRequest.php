<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssetRequest extends FormRequest
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

    public function attributes()
    {
        return [

            'descr' => 'asset name ('.$this->descr.') ',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'descr' => ['string', 'required', 'max:40', 'unique:assets'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'descr' => strtolower($this->descr),
        ]);
    }


}
