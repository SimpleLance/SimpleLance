<?php

namespace SimpleLance\Http\Requests;

use SimpleLance\Http\Requests\Request;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class UpdateInvoiceRequest extends Request
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
            'due' => 'required',
            'status_id' => 'required',
            'owner_id' => 'required'
        ];
    }
}
