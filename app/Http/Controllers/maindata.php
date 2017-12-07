<?php
namespace App\Http\Controllers;
use App\Clients;
use App\ClientsFL;
use App\cat;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;

class maindata extends Controller
{
    function test(){

    	
    	$flights = cat::first();
    	
    		//var_dump($flights->Contracts());
    	
    }

 function byclient(){

    	
    	$client = Clients::find(44);
    	
    	//var_dump($client->incat->Contracts());
    	
    }


function GetPagin($onpage, $shift, $page, $totalcount){

 return array(
		"CurrentPage"	=> $page,
		"ItemsOnPage"	=> $onpage,
		"LastPage"		=> (integer)(($totalcount/$onpage)>round($totalcount/$onpage)?round($totalcount/$onpage,0)+1:round($totalcount/$onpage,0)),
		"FirstPage"		=> 1,
		"TotalCount"	=> (integer)$totalcount
	);

}


function GetMainList(Request $request) {
	$NewArray = array();
	$page   = $request->get('page');
	$onpage = $request->get('onpage');
	$shift  = $onpage*$page-$onpage;
	
	$search = array(
					'on_name' 	   => ( null!==($request->get('searchOnName'))?$request->get('searchOnName'):''), 
					'on_contracts' => ( null!==($request->get('searchOnContr'))?$request->get('searchOnContr'):'')
					);
	

	

	$MyDB = new dbclass;
	$mainList 		 = $MyDB->gettotallist($search, $onpage, $shift);
	$mainTotal_count = $MyDB->gettotallist_count($search);


	if (($shift*$page-$onpage)>$mainTotal_count ) {
		$Errors		= array("Error" => "Wrong paginate");
		$NewArray[] = NULL; 
	} else 
	{
	$Errors		= array("Error" => NULL);
	foreach ($mainList as $item) {

		$NewArray[] = 
		array(
				'ID' 		      => $item->id,
				'Name'		      => $item->NAM,
				
				// Формируем перечень неоплаченных договоров
				'NoPaidContracts' => (count ($MyDB->getNotPAIDContracts($item->id))>0 ? ($MyDB->getNotPAIDContracts_inArray($item->id)): NULL),			      		

				// Получаем количество услуг по оплаченным договорам
				'PaidServices'	  => $MyDB->getServiceListofPaidContract_count($item->id)[0]->C  
			);
	
	 }
	}

	
	$OUTARRAY = array(
					"items"    => (object)$NewArray, 
					"Paginate" => $this->GetPagin($onpage, $shift, $page, $mainTotal_count),
					"Errors"   => (object)$Errors
					);
	return response()->json((object)$OUTARRAY,201);

	




}

	// Функция определения информации о клиенте по идентификатору
	function GetUserINF (Request $request){
	if (strlen($request->get('UID')>0)) {
			$client = cat::find($request->get('UID'));
			
			if (!$client->idOfClient) {
				// Выборка данных из таблицы физических лиц				
				$MyClient = ClientFL::find($client->idOfClientFL);
				$STAT 	   ="FL";

			} else {
				//выборка данных из таблиц юрлиц
				 $MyClient = Clients::find($client->idOfClient);
				 $STAT 	   = "UL";

			}
		    $OUT = array ("Client"=>$MyClient, "STATUS" => $STAT);
			
			return response()->json($OUT,200);
	} else {
		$OUT = array("Client"=>NULL,"ERROR"=>"No UID in base");
		return response()->json($OUT,404);
	}

	}

	// Функция редиктирования данных о клиенте
	function SetUserInf(Request $request){
		if (strlen($request->get('UID')>0)) {
			
			$client = cat::find($request->get('UID'));
			

			if (!$client->idOfClient) {
				// Выборка данных из таблицы физических лиц				
				$MyClient = ClientFL::find($client->idOfClientFL);

				if (!empty($request->get('name'))) 	 		$MyClient->name = $request->get('name');
				if (!empty($request->get('surname'))) 		$MyClient->name = $request->get('surname');
				if (!empty($request->get('patronimic'))) 	$MyClient->name = $request->get('patronimic');
				if (!empty($request->get('BankAccount'))) 	$MyClient->name = $request->get('BankAccount');
				if (!empty($request->get('livingAddress'))) $MyClient->name = $request->get('livingAddress');

				$status = $MyClient->save();



			} else {
				//выборка данных из таблиц юрлиц
				 $MyClient = Clients::find($client->idOfClient);
				 if (!empty($request->get('name'))) 	 			$MyClient->name = $request->get('name');
				 if (!empty($request->get('mainBankAccount')))		$MyClient->name = $request->get('mainBankAccount');
				 if (!empty($request->get('postAddress')))			$MyClient->name = $request->get('postAddress');
				 if (!empty($request->get('registrationAddress')))	$MyClient->name = $request->get('registrationAddress');

				 $status = $MyClient->save();


			}

			$OUT = array ("Client"=>$MyClient, "SAVED"=>$status);
			return response()->json($OUT,200);
	} else {


		$OUT = array("Client"=>NULL,"ERROR"=>"No UID in base");
		return response()->json($OUT,404);
	}

	}

}
