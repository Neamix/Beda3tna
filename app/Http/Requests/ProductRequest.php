<?php

namespace App\Http\Requests;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'categories' => ['required',function($value,$attribute,$fail){
                $categories = Category::whereIn('id',$this->categories)->count();
 
                if( $categories != count($this->categories)) {
                    return $fail('some categories ids don\'t exist');
                }
            }],

            'brand_id' => ['required',function($value,$attribute,$fail){
                $brand = Brand::whereIn('id',[$this->brand_id])->count();

                if( ! $brand ) {
                    return $fail('this brand id doesn\'t exist');
                }
            }]
        ];
    }
}
