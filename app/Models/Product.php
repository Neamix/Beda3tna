<?php

namespace App\Models;

use App\Traits\validationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory,validationTrait;

    protected $guarded = [];
    protected $with = ['categories'];

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

        return self::validateResult('success',$product);
    }

    public function deleteInstance() {
        $this->categories()->detach();
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
}
