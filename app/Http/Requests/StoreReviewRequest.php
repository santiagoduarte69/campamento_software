<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreReviewRequest extends FormRequest
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
            "title" => 'required|max:20',
            "text" => 'required|max:50',
            "rating" => 'required|integer|between:1,10',
            "bootcamp_id" => 'required|exists:bootcamps,id',
            "user_id" => 'required|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Titulo obligatorio',
            'title.max' =>'El titulo es muy grande en caracteres.',

            'text.required' => 'Texto obligatorio',
            'text.max' =>'El texto es muy grande en caracteres.',
             
            'rating.required' => 'Rating obligatoria',
            'rating.between' =>'el maximo de rating es 10.',

            'bootcamp_id.required' => 'Agrega el id',
            'bootcamp_id.exists' => 'El id del bootcamp no existe',

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
