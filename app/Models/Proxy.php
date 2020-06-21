<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proxy extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'proxies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['provider_id', 'ip','port','type', 'check_timestamp', 'last_found_date', 'last_fun_date'];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;


}