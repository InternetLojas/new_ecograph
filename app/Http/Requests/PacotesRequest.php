<?php namespace Ecograph\Http\Requests;

use Ecograph\Http\Requests\Request;

class PacotesRequest extends Request {


	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{

        return [
            'quantity' => 'required|numeric'
        ];
	}

}
