<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCourseRequest extends FormRequest
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
            "title" => 'required|min:10|max:30',
            "description" => 'required|min:10',
            "weeks" => 'required|integer|between:1,9',
            "enroll_cost" => 'integer|required',
            "minimum_skill" => 'required|in:Beginner,Intermediate,Advanced,Expert',
            "bootcamps_id" => 'required|exists:bootcamps,id'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Titulo obligatorio',
            'title.min' =>'El titulo es muy corto en caracteres.',
            'title.max' =>'El titulo es muy grande en caracteres.',

            'description.required' => 'Descripcion obligatoria',
            'description.min' =>'La descripcion es muy corta en caracteres.',
             
            'weeks.required' => 'Weeks obligatoria',
            'weeks.between' =>'el maximo de semanas es 9.',

            'bootcamps_id.required' => 'Agrega el id',
            'bootcamps_id.exists' => 'El id del bootcamp no existe'
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
