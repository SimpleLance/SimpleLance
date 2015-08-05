<?php

namespace SimpleLance\Http\Requests;

use SimpleLance\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class StoreProjectRequest extends Request
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
            'title' => 'required',
            'description' => 'required',
            'status_id' => 'required',
            'priority_id' => 'required',
            'owner_id' => 'required'
        ];
    }
}
