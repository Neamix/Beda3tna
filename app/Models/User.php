<?php

namespace App\Models;

use App\Traits\validationTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use validationTrait,HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static function upsertInstance($data) {
        $user = self::updateOrCreate(
            ['id' => $data->id ?? null],
            [
                'name' => $data->name,
                'email' => $data->email,
                'password' => Hash::make($data->password)
            ]
        );
        
        if(!Auth::attempt($data->all())) {
            return self::validateResult('fail','error occure');
        }

        $user->token = Auth::user()->createToken('auth_token')->accessToken;

        return self::validateResult('success',$user,);

    }

    static function login($user) {
        if(!Auth::attempt($user->all())) {
            return self::validateResult('fail','error occure');
        }

        Auth::user()->token = Auth::user()->createToken('auth_token')->accessToken;

        return self::validateResult('success',Auth::user()); 
    }

    public function deleteInstance() {
        $this->delete();
        return self::validateResult('success',Auth::user());
    }

    public function logout() {
        $this->token()->revoke();
        return self::validateResult('success');
    }

    public function isAdmin() {
        if($this->priviledge->whereIn('id',[SUPER_ADMIN,SYSTEM_ADMIN])->count()) {
            return true;
        } else {
            return false;
        }
    }

    public function isSuperAdmin() {
        if($this->priviledge->whereIn('id',[SUPER_ADMIN])->count()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Use Priviledge Request in validation
     */

    public function toggleAdmin() {
        $this->priviledge->toggle([SYSTEM_ADMIN]);
        return self::validationResult('success',$this->priviledge);
    }

    public function toggleSuperAdmin() {
        $this->priviledge->toggle([SUPER_ADMIN]);

        return self::validationResult('success',$this->priviledge);
    }

    public function togglePriviledge($priviledge) {
        $this->priviledge->toggle($priviledge);
        return self::validationResult('success',$this->priviledge);
    }
}
