<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'user_id' => [function($value,$attribute,$fail){
               
                if( isset($this->user_id) ) {
                    $user = User::find($this->user_id);
                    
                    if( ! $user) {
                        return $fail('this user doesn\'t exist');  
                    }
                }

            }],

            'products_ids' => ['required',function($value,$attribute,$fail){
               if( isset($this->products_ids) ) {
                    $checkProductsExists = Product::whereIn('id',$this->products_ids)->count();
                    
                    if( $checkProductsExists != count($this->products_ids) ) {
                        return $fail('some of this products doesn\'t exist');
                    }

               }
            }]
        ];
    }
}
