<?php

namespace App\Models;

use App\Traits\validationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory,validationTrait;

    protected $guarded = [];

    static function upsertInstance($data) {
        $brand = self::updateOrCreate(
            ['id' => $data->id ?? null],
            [
                'name' => $data->name,
            ]
        );

        return self::validateResult('success',$brand);
    }

    public function deleteInstance() {
        $this->delete();
        return self::validateResult('success',$this);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}
