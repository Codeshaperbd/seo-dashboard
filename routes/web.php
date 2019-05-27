<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/access-denied', 'Controller@getUnauthorized')->name('unauthorized')->middleware('verified');

Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function(){

	Route::get('services', 'ClientDashboardController@getServicesPage')->name('services');
	Route::get('services/{slug}', 'ClientDashboardController@getServiceDetails')->name('services.details');

	Route::get('cart', 'ClientDashboardController@cartPage')->name('cart.index');
	Route::post('cart', 'ClientDashboardController@storeIntoCart')->name('cart.store');
	Route::get('cart/{id}', 'ClientDashboardController@removeFromCart')->name('cart.remove');

	Route::get('checkout', 'ClientDashboardController@getCheckoutPage')->name('checkout');
	Route::post('checkout', 'ClientDashboardController@performCheckout')->name('checkout.store');

	Route::get('checkout-confirmation', 'ClientDashboardController@getConfirmationPage')->name('checkout.confirmation');


	Route::get('orders', 'ClientDashboardController@getOrdersPage')->name('order.index');
	Route::get('order/{number}', 'ClientDashboardController@getOrderpage')->name('order.single');

	
	//invoices
	Route::post('invoices', 'ClientDashboardController@getInvoicePage')->name('invoice.client'); 



});


Route::post('/main-account', 'HomeController@backToAccount')->name('account.back')->middleware('auth');

//order message update
Route::post('/orders/message', 'HomeController@orderMessageUpdate')->name('order.message');


Route::middleware(['auth', 'verified', 'IsAdmin'])->group(function () {

	Route::get('settings/general', 'SettingController@getGeneralSettings')->name('settings.general');
	Route::put('settings/general', 'SettingController@updateGeneralSettings')->name('general.updadate');


	// Team account route
	Route::post('accounts-access', 'HomeController@accessAccount')->name('account.access');
	Route::resource('accounts', 'UserController', [
	    
	    'names' => [
	        'index' => 'account.index',
	        'create' => 'account.create',
	        'store' => 'account.store',
	        'edit' => 'account.edit',
	        'update' => 'account.update',
	        'destroy' => 'account.delete',

	    ]
	]);



	// Tag related route
	Route::resource('/settings/tags', 'TagController', [
	    
	    'names' => [
	        'index' => 'tag.index',
	        'create' => 'tag.create',
	        'store' => 'tag.store',
	        'edit' => 'tag.edit',
	        'update' => 'tag.update',
	        'destroy' => 'tag.delete',

	    ]
	]);

	// Order Form create
	Route::resource('/order-form', 'FormBuilderController', [
	    
	    'names' => [
	        'index' 	=> 'order-form.index',
	        'create' 	=> 'order-form.create',
	        'store' 	=> 'order-form.store',
	        'edit' 		=> 'order-form.edit',
	        'update' 	=> 'order-form.update',
	        'destroy' 	=> 'order-form.delete',

	    ]
	]);
	// Activity logs route
	Route::resource('/logs', 'ActivityController', [
	    
	    'names' => [
	        'index' => 'log.index',
	        'create' => 'log.create',
	        'store' => 'log.store',
	        'edit' => 'log.edit',
	        'update' => 'log.update',
	        'destroy' => 'log.delete',

	    ]
	]);


	


	Route::resource('roles', 'RoleController', [
	    
	    'names' => [
	        'index' => 'role.index',
	        'create' => 'role.create',
	        'store' => 'role.store',
	        'edit' => 'role.edit',
	        'update' => 'role.update',
	        'destroy' => 'role.delete',

	    ]
	]);


	Route::resource('/services', 'ServiceController', [
	    
	    'names' => [
	        'index' => 'service.index',
	        'create' => 'service.create',
	        'store' => 'service.store',
	        'edit' => 'service.edit',
	        'update' => 'service.update',
	        'destroy' => 'service.delete',

	    ]
	]);

	Route::resource('/clients', 'ClientController', [
	    
	    'names' => [
	        'index' => 'client.index',
	        'create' => 'client.create',
	        'store' => 'client.store',
	        'show' => 'client.show',
	        'edit' => 'client.edit',
	        'update' => 'client.update',
	        'destroy' => 'client.delete',

	    ]
	]);


	//Route::get('order/{number}', 'OrderController@getOrderpage')->name('order.details');

	//order note update
	Route::put('/orders/update-note/{number}', 'OrderController@updateOrderNote')->name('orderNote.update');
	Route::delete('/orders/messages/delete/{id}', 'OrderController@deleteMessage')->name('message.delete');

	//order status
	Route::put('/orders/staus/{number}', 'OrderController@orderStatus')->name('order.state');

	//assing orders
	Route::put('/orders/assing/{number}', 'OrderController@assignOrders')->name('order.assign');


	//order follow or unfollow
	Route::put('/orders/follow/{number}', 'OrderController@orderFollow')->name('order.follow');


	//assign tags
	Route::put('/orders/tags/{number}', 'OrderController@assignTags')->name('assign.tags');
	

	Route::resource('/orders', 'OrderController', [
	    
	    'names' => [
	        'index' => 'order.main',
	        'create' => 'order.create',
	        'store' => 'order.store',
	        'show' => 'order.show',
	        'edit' => 'order.edit',
	        'update' => 'order.update',
	        'destroy' => 'order.delete',

	    ]
	]);

	Route::resource('/invoices', 'InvoiceController', [
	    
	    'names' => [
	        'index' => 'invoice.index',
	        'create' => 'invoice.create',
	        'store' => 'invoice.store',
	        'show' => 'invoice.show',
	        'edit' => 'invoice.edit',
	        'update' => 'invoice.update',
	        'destroy' => 'invoice.delete',

	    ]
	]);


	





	Route::get('/profile', function () {
	    return view('profile');
	})->name('profile');
});
