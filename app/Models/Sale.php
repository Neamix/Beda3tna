<?php

namespace App\Models;

use App\Traits\validationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory,validationTrait;

    protected $guarded = [];

    static function upsertInstance($data) {
        $sale = self::updateOrCreate(
                ['id' => $data->id],
                [
                    'product_id' => $data->product_id,
                    'precent'    => $data->precent
                ]
            );

        $sale->product = $sale->product()->get();

        return self::validateResult('success',$sale);
    }

    public function deleteInstance() {
        $this->delete();
        return $this;
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

}
