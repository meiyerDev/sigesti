<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DatosRequest extends FormRequest
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
			'responsable'			=>	['required'],
			'identity'				=>	['nullable','required_if:responsable,nuevo','unique:people','numeric','min:7'],
			'first_name'			=>	['nullable','required_if:responsable,nuevo','string','min:3','max:20'],
			'last_name'				=>	['nullable','required_if:responsable,nuevo','string','min:3','max:20'],
			'phone'					=>	['nullable','numeric','min:11'],
			'type'					=>	['required'],
			'requested'				=>	['required'],
			'model'					=>	['required'],
			'brand'					=>	['required'],
			'serial'				=>	['required'],
			'code'					=>	['required_if:type,Cartucho'],
			'name_otro'				=>	['nullable','required_if:type,Otro','min:3','string'],
			'inche'					=>	['nullable','required_if:type,Monitor','required_if:type,Monitor-Desktop'],
			'model_cpu'				=>	['required_if:type,Monitor-Desktop'],
			'brand_cpu'				=>	['required_if:type,Monitor-Desktop'],
			'serial_cpu'			=>	['required_if:type,Monitor-Desktop'],
			'ram'					=>	['nullable','string'],
			'observation_cpu'		=>	['nullable','string'],
			'processor'				=>	['nullable','string'],
			'so'					=>	['required_if:type,Cpu','required_if:type,Monitor-Desktop'],
			'memory_video'			=>	['nullable','string'],
			'department'			=>	['required'],
			'departmento'			=>	['nullable','required_if:department,nuevo','unique:departments,department','string','max:50','min:3']
		];
	}

	// public function messages()
	// {
	// 	return [
	// 	];
	// }

	public function attributes()
	{
		return [
			'identity'      		=>  'Cedula',
			
		];
	}
}
