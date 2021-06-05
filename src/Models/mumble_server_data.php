<?php

namespace ArielHeleneto\Seat\Mumble\Models;

use Illuminate\Database\Eloquent\Model;

class mumble_server_data extends Model
{
    /**
     * @var string
     */
    protected $table = 'mumble_server_data';

    /**
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * @var bool
     */
    public $incrementing = false;protected $fillable = ['user_id', 'username', 'password'];
}

