<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('database', function(){
	Schema::create('Users', function($table){
		$table->string('id',20)->primary;
		$table->string('name',200);
		$table->integer('status',10);
	});
	echo "Da tao bang Users";
	Schema::create('Contracts', function($table){
		$table->string('id',20)->primary;
		$table->string('name',200);
		$table->string('contractId',20);
		$table->integer('status',10);
		$table->string('user_id',20)->unsigned();
		$table->foreign('user_id')->references('id')->on('Users');
	});
	echo "Da tao bang Contracts";
});
Route::get('demo',function(){
	$data=DB::table('contract')->get();
	var_dump($data);
});

Route::group(['prefix'=>'contract', 'middleware' => 'auth'],function(){
	Route::get('', 'ContractController@index')->name('index'); // Hiển thị danh sách contract
	Route::get('create', 'ContractController@create')->name('create'); // Thêm mới contract
	Route::post('/store', 'ContractController@store')->name('store'); // Xử lý thêm mới contract
	Route::get('/edit/{id}', 'ContractController@edit')->name('edit'); // Sửa contract
	Route::post('/sua', 'ContractController@sua')->name('sua'); // Xử lý sửa contract
	Route::get('/delete/{id}', 'ContractController@deleteContract')->name('delete'); // Xóa contract
	Route::post('/destroy/{id}', 'ContractController@destroy')->name('destroy'); // Xóa contract
	Route::get('/chuyen/{user_id}/{id}','ContractController@chuyen')->name('chuyen');
	Route::post('/change/{id}','ContractController@change')->name('change');
	Route::get('/logcontract/{id}','ContractController@logcontract')->name('logcontract');
	Route::get('/logcontract/create/{id}','ContractController@createLog')->name('createLog');
	Route::post('/logcontract/insert','ContractController@insert')->name('insert');
	Route::get('logcontract/{idContract}/edit/{idLog}','ContractController@editLog')->name('editLog');
	Route::post('logcontract/edit','ContractController@updateLog')->name('updateLog');
	Route::post('logcontract/{idContract}/delete/{idLog}','ContractController@deleteLog')->name('deleteLog');
	Route::get('profile/{id_user}','ContractController@profile')->name('profile');
	Route::post('profile/{id_user}','ContractController@updateProfile')->name('updateProfile');
});
Route::get('dangnhap','ContractController@dangnhap')->name('dangnhap')->middleware('CheckUser');
// ->middleware('CheckUser');
Route::post('dangnhap','ContractController@kiemtra_user')->name('user');
Route::get('dangxuat','ContractController@dangxuat')->name('dangxuat');

Route::get('/form',function(){
	return view('postForm');
});
Route::get('uploadFile','ContractController@uploadFile');
Route::post('postFile','ContractController@postFile')->name('postFile');
Route::get('dangky','ContractController@dangky')->name('dangky');
Route::post('xulydangky','ContractController@xulydangky')->name('xulydangky');
Route::get('admin',function(){
	return view('layouts.admin_template');
});
Route::get('blade', function () {
    return view('child');
});
Route::get('diem',function(){
	echo " Bạn đã đủ điểm";
})->middleware('MyMiddle')->name('diem');
Route::get('loi', function(){
	echo "Bạn chưa đủ điểm";
})->name('loi');
Route::get('nhapdiem', function(){
	return view('nhapdiem');
})->name('nhapdiem');
Route::get('vue','ContractController@listData')->name('vue');
Route::get('allClients','ContractController@dataclients')->name('dataclients');






// Route::auth();

// Route::get('/home', 'HomeController@index');

// Route::auth();

// Route::get('/home', 'HomeController@index');
