<?php

namespace App\Models;

use App\Traits\validationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory,validationTrait;

    protected $guarded = [];
    protected $with = ['categories','brand','sale','images'];

    static function upsertInstance($data) {
        $product = self::updateOrCreate(
            ['id' => $data->id ?? null],
            [
                'name' => $data->name,
                'price' => $data->price,
                'brand_id' => $data->brand_id
            ]
        );
        
        $product->categories()->sync($data->categories);
        $product->categories = $product->categories()->get();
        $product->brand = $product->brand()->get();

        if($data->images) {
            $srcs = Images::storeImages($data->images);
            $images = $product->images()->sync($srcs);
            $product->images = $product->images()->get();
        }



        return self::validateResult('success',$product);
    }

    public function deleteInstance() {
        $this->categories()->detach();
        $this->sale()->delete();
        $this->delete();

        return self::validateResult('success',$this);
    }

    public function categories() {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function orders() {
        return $this->belongsToMany(Order::class)->withTimestamps();
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function sale() {
        return $this->hasMany(Sale::class);
    }

    public function getSalePrecentAttribute() {
        $getSale = $this->sale()->first();
       
        if($getSale) {
            return $getSale->precent;
        } else {
            return null;
        }

    }

    public function getProductPriceAttribute() {
        if($this->sale_precent) {
            $saleDiscount = $this->price * ($this->sale_precent/100);
            return $this->price - $saleDiscount;
        }  else {
            return $this->price;
        }
    }

    public function images() {
        return $this->belongsToMany(Images::class,'image_product');
    }

    
}
