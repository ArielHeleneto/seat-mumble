<?php

namespace ArielHeleneto\Seat\Mumble\Models;

use ArielHeleneto\Seat\Mumble\Models\mumble_server_data;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;use Seat\Web\Models\User;use ArielHeleneto\Seat\Mumble\Helpers;

class mumble_user_setting extends Model
{
    /**
     * @var bool
     */
    public $incrementing = false;
    /**
     * @var string
     */
    protected $table = 'mumble_user_settings';
    /**
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['id','username','password'];
    protected static function booted()
    {
        static::saved(function ($mumble_user_setting) {
            $fuck=mumble_server_data::find($mumble_user_setting->id)->firstOr(function () {
                $fuck = new mumble_server_data;
                $fuck->id = $mumble_user_setting->id;
                $fuck->username = $mumble_user_setting->username;
                $fuck->password = $mumble_user_setting->password;
                $ro=User::find(Auth::id())->roles();
                $grou='';
                foreach ($ro as $meige){
$grou=$grou.$meige.',';
                }
                rtrim($grou,",");
                $fuck->groups=$grou;
                $fuck->display_name=Helper::buildNickname(User::find(Auth::id()));
                $fuck->save();
            });
        });
    }
}
