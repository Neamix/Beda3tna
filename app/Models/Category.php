<?php

namespace App\Models;

use App\Traits\ValidationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory,validationTrait;

    protected $guarded = [];

    static function upsertInstance($data) 
    {
        $category = self::updateOrcreate(
            ['id' => $data->id ?? null],
            [
                'name' => $data->name,
            ]
        );

        return self::validateResult('success',$category);
    }

    public function deleteInstance() {
        $this->delete();
        return self::validateResult('success',$this);
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
