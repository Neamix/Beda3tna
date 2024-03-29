<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => ['required',function($value,$attribute,$fail){
                if( isset($this->id) ) {
                    $getCategory = Category::where('id','<>',$this->id)->where('name',$this->name)->pluck('name')->toArray();

                    if( count($getCategory) ) {
                        return $fail('The name has already been taken');
                    }

                } else {
                    $getCategory = Category::where('name',$this->name)->pluck('name')->toArray();

                    if( count($getCategory) ) {
                        return $fail('The name has already been taken');
                    }
                }
            }]
        ];
    }
}
