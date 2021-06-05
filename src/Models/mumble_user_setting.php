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

    public function refresh()
    {
        $fuck = mumble_server_data::firstOrCreate(
            ['user_id' => $this->id],
            ['username' => $this->username]
        );
        $fuck->password = $this->password;
        $ro = User::find($this->id)->roles;
        $grou = '';
        foreach ($ro as $meige) {
            $grou = $grou . $meige->title . ',';
        }
        $grou = substr($grou, 0, -1);
        $fuck->groups = $grou;
        $fuck->display_name = Helper::buildNickname(User::find($this->id));
        foreach ($ro as $meige) {
            if ($meige->description != NULL) {
                $fuck->display_name = $fuck->display_name . '[' . $meige->description . ']';
            }
        }
        $fuck->save();
        return $fuck;
    }

    protected static function boot()
    {
        mumble_user_setting::saved(function ($mumble_user_setting) {
            $mumble_user_setting->refresh();
        });
        static::bootTraits();
    }
}
