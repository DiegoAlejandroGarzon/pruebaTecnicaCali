<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userUpdateRequest extends FormRequest
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
            'firstName'=>'required',
            'surname'=>'required',
            'secondSurname'=>'required',
            'documentType'=>'required',
            'documentNumber'=>'required',
            'email'=>'required|email|unique:users,email,'.$this->idUser,
        ];
    }

    public function messages(){
        return[
            'firstName.required'=>'El campo primer nombre es requerido',
            
            'surname.required'=>'El campo primer apellido es requerido',
            
            'secondSurname.required'=>'El campo segundo apellido es requerido',
            
            'documentType.required'=>'El campo tipo de documento es requerido',
            
            'documentNumber.required'=>'El campo numero de documento es requerido',

            'email.required'=>'El campo Correo Electronico es requerido',
            'email.email'=>'El dato ingresado no es un Correo Electronico',
            'email.unique'=>'El Correo Electronico ya esta registrado',
        ];
    }
}
