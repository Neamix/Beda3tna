<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
            'precent' => ['required','integer','between:0,100'],
            'product_id' => ['required',function($value,$attribute,$fail){
                if( isset($this->product_id) ) {
                    $product = Product::find($this->product_id);
                    
                    if( ! $product ) {
                        return $fail('this product does\'t exsit');
                    }

                    $args = $this;

                    $getProductSale = Sale::where(function($query) use ($args) {
                        if( $this->id ) {
                            $query->where('id','<>',$args->id);
                        } 
                    })->where('product_id',$args->product_id)->get();
                    
                    if( count($getProductSale) ) {
                        return $fail('this product already has sale');
                    }
                }
            }]
        ];
    }
}
