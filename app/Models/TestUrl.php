<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestUrl extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'testurls';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['testurl', 'ip', 'port', 'status', 'success_time'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public static function getTestUrl() {
        $testurls = TestUrl::all();
        return $testurls;
    }

}