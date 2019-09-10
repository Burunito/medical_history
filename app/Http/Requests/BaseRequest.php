<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator as FormRequestValidator;

class BaseRequest extends FormRequest
{
    protected function failedValidation(FormRequestValidator $v){
        $request = $this;
        if(substr($this->path(), 0 , 3) == 'api' || $request->ajax())
            throw new HttpResponseException(response()->json(['errors' => $v->errors()->all(), 'status' => 400], 400));

        parent::failedValidation($v);
    }
}
