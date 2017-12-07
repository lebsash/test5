<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class servoncontr extends Model
{

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'servoncontrs';
 	 
 	 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
 	public $timestamps = true;


 	protected $fillable = ['NumOfContract', 'NumOfService'];
            

    /**
     * Get the GetContract
     */
    public function GetContract()
    {
        return $this->hasMany('App\servoncontr', 'NumOfService','id');
    }

     /**
     * Get the GetContract
     */
    public function GetServices()
    {
        return $this->hasMany('App\services', 'id','NumOfService');
    }
}
