<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SystemRequest extends FormRequest
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
            'imageLarge' => [function($value,$attribute,$fail){
                $dimintions = explode('X',$this->imageLarge);
                if(count($dimintions) != 2) {
                    return $fail('error in size');
                }

                $checkDimintionOneTypeIsInteger = is_numeric($dimintions[0]); 
                $checkDimintionTwoTypeIsInteger = is_numeric($dimintions[1]); 

                if($checkDimintionOneTypeIsInteger != 'integer' || $checkDimintionTwoTypeIsInteger != 'integer') {
                    return $fail('error in type');
                }
            }],
            'imageMedium' => [function($value,$attribute,$fail){
                $dimintions = explode('X',$this->imageLarge);
                if(count($dimintions) != 2) {
                    return $fail('error in size');
                }

                $checkDimintionOneTypeIsInteger = is_numeric($dimintions[0]); 
                $checkDimintionTwoTypeIsInteger = is_numeric($dimintions[1]); 

                if($checkDimintionOneTypeIsInteger != 'integer' || $checkDimintionTwoTypeIsInteger != 'integer') {
                    return $fail('error in type');
                }
            }],
            'imageSmall'  => [function($value,$attribute,$fail){
                $dimintions = explode('X',$this->imageLarge);
                if(count($dimintions) != 2) {
                    return $fail('error in size');
                }

                $checkDimintionOneTypeIsInteger = is_numeric($dimintions[0]); 
                $checkDimintionTwoTypeIsInteger = is_numeric($dimintions[1]); 

                if($checkDimintionOneTypeIsInteger != 'integer' || $checkDimintionTwoTypeIsInteger != 'integer') {
                    return $fail('error in type');
                }
            }]
        ];
    }
}
