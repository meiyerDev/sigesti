<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpertRequest extends FormRequest
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
			'identity'		=>	['required','unique:people,identity','min:7'],
			'first_name'	=>	['required','string','min:3'],
			'last_name'		=>	['required','string','min:3'],
			'phone'			=>	['nullable','string','max:12'],
            'user' 			=> 	['required', 'string', 'max:20', 'unique:users'],
            'password' 		=> 	['required', 'string', 'min:4']
		];
	}

	public function messages()
	{
		return [
			'identity.unique' => 'La Cedula ingresada para el nuevo técnico ya está en uso',
			'user.unique' => 'El Usuario ingresado para el nuevo técnico ya está en uso'
		];
	}
}
