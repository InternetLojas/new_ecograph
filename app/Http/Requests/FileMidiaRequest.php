<?php namespace Ecograph\Http\Requests;

use Ecograph\Http\Requests\Request;

class FileMidiaRequest extends Request {

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
            'logo1' => 'image',
            'logo2' => 'image'
        ];
	}

}
