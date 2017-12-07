 <?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group(['middleware' => 'api'], function () {
	
    
    /* Маршрут для работы с общим списком клиентов
	*
	*  Обязательные поля: 
	*		page   - Текущая страница пагинации
	*		onpage - Количество строк на странице для пагинации
	*
	*  Допустимые значения в запросе GET: 
	*		searchOnName  - текст для поиска в в наименовании клиента
	*		searchOnContr - текст для поиска среди номеров неоплаченных договоров (2й столбец выборки)
	*/
	Route::get('getlist',  'maindata@GetMainList');  

	// 
	/* Маршрут для получения информации о клиенте
	*
	*  Обязательное поле: UID - идентификатор пользователя в основной таблице cat
	*  
	*
	*/
	Route::get('client',   'maindata@GetUserINF');

	
	/* Маршрут для редактирования информации о клиенте
	*
	*  Обязательное поле: UID - идентификатор пользователя в основной таблице cat
	*  Допустимые значения в запросе GET:  
	*		Для физлиц: name, surname, patronimic, BankAccount, livingAddress
	*		Для юрлиц:  name, mainBankAccount, postAddress, registrationAddress
	*/
	Route::get('clientmod','maindata@SetUserINF');
});
