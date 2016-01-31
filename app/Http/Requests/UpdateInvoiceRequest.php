<?php

namespace SimpleLance\Http\Requests;

use Illuminate\Support\Facades\Auth;
use SimpleLance\Http\Requests\Request;

class UpdateInvoiceRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
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
            'status_id' => 'required|exists:statuses,id',
            'owner_id' => 'required'
        ];
    }
}
