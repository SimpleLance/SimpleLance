<?php

namespace SimpleLance\Http\Requests;

use SimpleLance\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class StoreInvoiceItemRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Sentry::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'invoice_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'total' => 'required'
        ];
    }
}
