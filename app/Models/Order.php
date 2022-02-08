<?php

namespace App\Models;

use App\Traits\validationTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory,validationTrait;

    protected $guarded = [];

    static function upsertInstance($data) {
        $orderCost = self::getOrderTotalCost($data->products_ids);
       
        $order = self::updateOrCreate(
            ['id' => $data->id],
            [
                'cost' => $orderCost,
                'user_id' => $data->user_id ?? Auth::id(),
                'date' => $data->date ?? Carbon::now(),
            ]
        );

        return self::validateResult('success',$order);
    }

    static function getOrderTotalCost($products_ids) {

        $productPriceSummition = 0;

        foreach($products_ids as $product_id) {
            $product = Product::find($product_id);
            $productPriceSummition += $product->price;
        }

        return $productPriceSummition;

    }

    public function deleteInstance() {
        $this->delete();
        return self::validateResult('success',$this);
    }
}
