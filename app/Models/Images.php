<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Image;

class Images extends Model
{
    use HasFactory;

    protected $guarded = [];

    static function storeImages($images) {
        foreach($images as $key => $image) {
            $name = uniqid() . '.png';
            $dimintionsArray = [
                'large' => getSystemVariable('imageLarge'),
                'medium' => getSystemVariable('imageMedium'),
                'small'  => getSystemVariable('imageSmall')
            ];

            $idsArray = [];

            foreach($dimintionsArray as $key => $dimintion)
            {
                $dimintion = explode('X',$dimintion[0]['value']);
                $src = public_path('images')."/$key/".$name;
                self::resize($image,$dimintion)->save(public_path('images')."/$key/".$name);
                $imageInstance = self::create([
                    'src' => $src
                ]);

                array_push($idsArray,$imageInstance->id);
            }

            return $idsArray;
        }
        
    }

    static function resize($image,$dimintion) {
        $imgFile = Image::make($image->getRealPath());
        return $imgFile->resize($dimintion[0], $dimintion[1], function ($constraint) {
            $constraint->aspectRatio();
        });
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
