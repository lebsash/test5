<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class controncat extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'controncats';
 	 
 	 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
 	public $timestamps = true;


 	protected $fillable = ['idcats', 'numOfContract'];
            
 	 /**
     * Get the GetCat
     */
    public function GetCat()
    {
        return $this->hasOne('App\cat', 'id','idcats');
    }

    /**
     * Get the GetContract
     */
    public function GetContract()
    {
        return $this->hasOne('App\contract', 'number','numOfContract');
    }


    /**
     * Get the GetContractNoPAID
     */
    public function GetContractNoPAID()
    {

        return $this->hasOne('App\contract', 'number','numOfContract')->where('state', 'like','%not paid%');
    }

    

}
