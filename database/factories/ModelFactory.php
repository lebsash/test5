<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Clients::class, function (Faker\Generator $faker) {
    return [             
           'name' 			 	 => $faker->company,
           'mainBankAccount' 	 => $faker->bankAccountNumber,
           'postAddress'	     => $faker->address,
           'registrationAddress' => $faker->address
    ];
});



$factory->define(App\ClientsFL::class, function (Faker\Generator $faker) {
    return [             
           'name' 			 	 => $faker->firstName,
           'surname' 			 => $faker->lastName,
           'patronimic' 		 => $faker->lastName,
           'bankAccount' 	 	 => $faker->bankAccountNumber,
           'livingAddress'	     => $faker->address
          
    ];
});

 	
$factory->define(App\contract::class, function (Faker\Generator $faker) {
	$startingDate = $faker->dateTimeThisYear('+1 month');
	$endingDate = $faker->dateTimeThisYear('+'.(string)rand(2,10).' month');	
   // $endingDate   = strtotime('+1 Week', $startingDate->getTimestamp());
    $state 		  = array('paid','not paid');
    return [             
           'number' 		 => str_random(10),
           'state' 			 => $faker->randomElement($state),
           'dateStart' 		 => $startingDate,
           'dateEnd' 	 	 => $endingDate
        
          
    ];
});


$factory->define(App\services::class, function (Faker\Generator $faker) {

    return [             
           'ServiceName' 		 => $faker->unique()->word(),
           'ServiceDescription'  => $faker->paragraph,
           
          
    ];
});



$factory->define(App\cat::class, function (Faker\Generator $faker) {

        
        $cub = rand(1,2);
		if ($cub == 1) {        
			$idOfClient   = NULL;
			$idOfClientFL = App\ClientsFL::pluck('id')->random();
        					
		} else {
			$idOfClient   = App\Clients::pluck('id')->random();
			$idOfClientFL = NULL;
		}
   
    return [

        			'idOfClient'   => $idOfClient,
        			'idOfClientFL' => $idOfClientFL,

    ];
});


$factory->define(App\controncat::class, function (Faker\Generator $faker) {
	
    return [

        'idcats' => function () {
            return App\cat::pluck('id')->random();
        },
        'numOfContract' => function(){
        	return App\contract::pluck('number')->random();
        }
    ];
});
     

$factory->define(App\servoncontr::class, function (Faker\Generator $faker) {
    return [

        'NumOfService' => function () {
            return App\services::pluck('id')->random();
        },
        'NumOfContract' => function () {
         	return App\contract::pluck('number')->random();
        }
    ];
});
