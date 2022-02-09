<?php

namespace App\Models;

use App\Traits\validationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use HasFactory,validationTrait;
    protected $hidden = ['id','created_at','updated_at'];

    static function systemUpdate($data) {
        $systems = $data->all();

        foreach($systems as $key => $value ) {
            System::where('key',$key)->update(['value'=>$value]);    
        }

        return self::validateResult('success');
    }

    static function getSystemVariable($key) {
        $system = System::where('key',$key)->get();

        if( ! $system ) {
            return self::validateResult('fail');
        }
        
        return self::validateResult('success',$system);
    }

}
