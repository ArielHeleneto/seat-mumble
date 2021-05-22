<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mumble_user_setting extends Model
{
    /**
     * @var string
     */
    protected $table = 'mumble_user_settings';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var bool
     */
    public $incrementing = false;
}
