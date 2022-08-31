<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBootcampRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => 'required| min:5',
            "user_id" => 'required|exists:users,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nombre obligatorio',
            'name.min' =>'El nombre del estudiante es muy corto en caracteres.',
            'user_id.required' => 'Agrega el id',
            'user_id.exists' => 'El id del usuario no existe'
        ];
    }

    //Metodo para enviar respuesta con errores de validacion
    protected function failedValidation(Validator $b){

        //Si la validacion falla se lanza una excepcion Http
        throw new HttpResponseException( 
            response()->json(["success" => false,
                              "errors" => $b->errors()
                             ], 422 )
        );
    }
}
