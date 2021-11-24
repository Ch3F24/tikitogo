<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'name' => 'required',
            'shipping_postal_code' => 'required|integer|between:1080,1099',
            'shipping_address' => 'required',
//            'vat_number' => 'required_without:same_as_shipping',
            'billing_name' => 'required_without:same_as_shipping',
            'billing_city' => 'required_without:same_as_shipping',
            'billing_postal_code' => 'required_without:same_as_shipping',
            'billing_address' => 'required_without:same_as_shipping',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Név',
            'shipping_address' => 'Szállítási cím',
            'billing_name' => 'Számlázási név',
            'billing_city' => 'Számlázási város',
            'billing_postal_code' => 'Számlázási irányítószám',
            'billing_address' => 'Számlázási cím',
        ];
    }

    public function messages()
    {
        return [
            'shipping_postal_code.between'  => 'Csak a 8. és a 9. kerületbe vállalunk szállítást.',
        ];
    }
}
