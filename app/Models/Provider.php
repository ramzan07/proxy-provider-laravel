<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'providers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public static function getProviders() {
        $providers = Provider::all();
        return $providers;
    }

}