<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clients';
 	 
 	 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
 	public $timestamps = true;

 	
 	protected $fillable = ['name', 'mainBankAccount', 'postAddress', 'registrationAddress' ];

     /**
     * Get from cat table clients ID
     */
    public function incat()
    {
        
     return $this->belongsTo('App\cat', 'id', 'idOfClient');

    }    




}
