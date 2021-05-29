<?php

namespace ArielHeleneto\Seat\Mumble\Models;

use ArielHeleneto\Seat\Mumble\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Seat\Web\Models\User;

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
    protected $fillable = ['id', 'username', 'password'];

    protected static function boot()
    {
        mumble_user_setting::saved(function ($mumble_user_setting) {
            $fuck = mumble_server_data::firstOrCreate(
                ['user_id' => $mumble_user_setting->id],
                ['username' => $mumble_user_setting->username]
            );
            $fuck->password = $mumble_user_setting->password;
            $ro = User::find(Auth::id())->roles;
            $grou = '';
            foreach ($ro as $meige) {
                $grou = $grou.$meige->title.',';
            }
            $grou = substr($grou, 0, -1);
            $fuck->groups = $grou;
            $fuck->display_name = Helper::buildNickname(User::find(Auth::id()));
            foreach ($ro as $meige) {
                if ($meige->description != null) {
                    $fuck->display_name = $fuck->display_name.'['.$meige->description.']';
                }
            }
            $fuck->save();

            return $fuck;
        });
        static::bootTraits();
    }
}
