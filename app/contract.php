<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contract extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contracts';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;


    protected $fillable = ['number', 'state', 'dateStart', 'dateEnd'];

    /**
     * Get the GetCat
     */
    public function GetCat()
    {
        return $this->hasOne('App\controncat', 'numOfContract','number');
    }

    /**
     * Get the GetServices
     */
    public function GetService()
    {
        return $this->hasOne('App\servoncontr', 'NumOfContract','number');
    }


}
