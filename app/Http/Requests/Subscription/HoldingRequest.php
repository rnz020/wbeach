<?php

namespace App\Http\Requests\Subscription;

use App\Http\Requests\Request;

class HoldingRequest extends Request
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
        $id = $this->segment(4);

        return [
                'group_name'    => ['required', 'max:200'],
                'legal_name'    => 'required|max:200',
                'ruc'           => 'required|max:11',
                'address'       => 'required|max:200',
        ];
    }
}
