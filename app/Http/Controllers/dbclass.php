<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class dbclass extends Controller
{
    

	// Получение глобального списка
    function gettotallist($search, $onpage, $shift){
    
        if (strlen($search["on_contracts"])>0) {

    // Если присутствует запрос на поиск среди неоплаченных контрактов, 
    // то в выборке долны присутствовать исключительно клиенты, имеющие неоплаченные контракты  
    return  DB::select("SELECT CONCAT_WS(' ',clients_f_ls.name, clients_f_ls.surname, clients_f_ls.patronimic, clients.name ) as NAM, cats.id 
                                from contracts as C 
                                RIGHT JOIN controncats as Ct ON Ct.numOfContract = C.number
                                LEFT JOIN cats as cats  ON cats.id = Ct.idcats
                                LEFT JOIN clients ON clients.id = cats.idOfClient
                                LEFT JOIN clients_f_ls ON clients_f_ls.id = cats.idOfClientFL
                                where C.number like ? and C.state = 'not paid' 
                                and CONCAT_WS(' ',clients_f_ls.name, clients_f_ls.surname, clients_f_ls.patronimic, clients.name ) like ?
                                GROUP by Ct.idcats order by cats.id asc
                                LIMIT ? OFFSET ?", ['%'.$search["on_name"].'%','%'.$search["on_contracts"].'%', $onpage, $shift]);    
    }
    else {
    
    // Если в запросе отсутствует поиск по наименованию неоплаченного контракта
    // то в выборке присутствуют абсолютно все клиенты
	return DB::select("SELECT CONCAT_WS(' ',Fl.name, Fl.surname, Fl.patronimic, Cl.name ) as NAM, A.id from cats as A 
							   LEFT JOIN clients as Cl ON A.idOfClient = Cl.id 
							   LEFT JOIN clients_f_ls as Fl ON A.idOfClientFL=Fl.id  
							   where (CONCAT_WS(' ',Fl.name, Fl.surname, Fl.patronimic, Cl.name ) like ?) 
							   order by A.id 
							   asc LIMIT ? OFFSET ?",['%'.$search['on_name'].'%',$onpage,$shift]);
	}
   
    	
    }



    // Получение количества записей глобального списка
    function gettotallist_count($search){
    
    if (strlen($search["on_contracts"])>0) {
    // Если присутствует запрос на поиск среди неоплаченных контрактов, 
    // то в выборке долны присутствовать исключительно клиенты, имеющие неоплаченные контракты  


    $res =  DB::select("SELECT count(*) as COUNT
                                from contracts as C 
                                RIGHT JOIN controncats as Ct ON Ct.numOfContract = C.number
                                LEFT JOIN cats as cats  ON cats.id = Ct.idcats
                                LEFT JOIN clients ON clients.id = cats.idOfClient
                                LEFT JOIN clients_f_ls ON clients_f_ls.id = cats.idOfClientFL
                                where C.number like ? and C.state = 'not paid' 
                                and CONCAT_WS(' ',clients_f_ls.name, clients_f_ls.surname, clients_f_ls.patronimic, clients.name ) like ?
                                GROUP by Ct.idcats 
                                ", ['%'.$search["on_name"].'%','%'.$search["on_contracts"].'%']); 
                               
    $tot_count = count($res);
    } else
    {
    // Если в запросе отсутствует поиск по наименованию неоплаченного контракта
    // то в выборке присутствуют абсолютно все клиенты
    $res = DB::select("SELECT count(*) as COUNT from cats as A 
                               LEFT JOIN clients as Cl ON A.idOfClient = Cl.id 
                               LEFT JOIN clients_f_ls as Fl ON A.idOfClientFL=Fl.id  
                               where (CONCAT_WS(' ',Fl.name, Fl.surname, Fl.patronimic, Cl.name ) like ?) 
                               ",['%'.$search["on_name"].'%']);
    $tot_count = $res[0]->COUNT;
    }
    return $tot_count;
        
    }


    // Получение списка оплаченных договоров
    function getPAIDContracts($UID, $search_usl = null){
    return	DB::select("SELECT C.number FROM controncats as T 
    						 LEFT JOIN contracts as C on T.numOfContract = C.number 
    						 WHERE T.idcats = ? AND C.state = 'paid'",
    						 [$UID]);

    }

	// Получение списка услуг по оплаченным договорам
	function getServiceListofPaidContract($UID){
    return  DB::select("SELECT S.ServiceName, S.ServiceDescription, T.numOfContract FROM controncats as T 
    						LEFT JOIN contracts as C on T.numOfContract = C.number 
    						LEFT JOIN servoncontrs as serv ON serv.NumOfContract = T.numOfContract 
    						LEFT JOIN services as S on S.id=serv.NumOfService 
    						WHERE T.idcats = ? AND C.state = 'paid'",[$UID]);
    }


    // Определение количества услуг по оплаченным договорам
    function getServiceListofPaidContract_COUNT($UID){
    return  DB::select("SELECT count(*) as C FROM controncats as T 
    						LEFT JOIN contracts as C on T.numOfContract = C.number 
    						LEFT JOIN servoncontrs as serv ON serv.NumOfContract = T.numOfContract 
    						LEFT JOIN services as S on S.id=serv.NumOfService 
    						WHERE T.idcats = ? AND C.state = 'paid'",[$UID]);
    }

	// Получение списка не оплаченных договоров
    function getNotPAIDContracts($UID){
    return DB::select("SELECT C.number FROM controncats as T 
    						 LEFT JOIN contracts as C on T.numOfContract = C.number 
    						 WHERE T.idcats = ? AND C.state = 'not paid'",
    						 [$UID]);    

    }


    // Возврат списка договоров в виде массива
	function getNotPAIDContracts_inArray($UID){
	$result = $this->getNotPAIDContracts($UID);	
	$OUT = array();
    	foreach ($result as $key => $value) {
    			 	$OUT[] = $value->number;
    	}
    return $OUT;
	}    

}
