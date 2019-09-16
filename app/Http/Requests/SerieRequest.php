<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SerieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method()){
            case 'GET': 
            case 'DELETE':{
                return [];
            }
            case 'POST':{
                return [
                    'fecha_caducidad' => 'required',
                    'cantidad' => 'required|numeric',
                    'lote_id' => 'required|exists:lotes,id'
                ];
            }
            case 'PUT':
            case 'PATCH':{
                return [
                    'fecha_caducidad' => 'required',
                    'cantidad' => 'required|numeric',
                    'lote_id' => 'required|exists:lotes,id'
                ];
            }
            default:break;
        }
    }
}
