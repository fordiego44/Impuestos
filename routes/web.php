<?php


Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('register', 'Auth\LoginController@register')->name('register');
Route::get('login', 'Auth\LoginController@viewLogin')->name('view.login');
Route::get('register', 'Auth\LoginController@viewRegister')->name('view.register');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::post('login-repartidor', 'Auth\LoginController@loginRepartidor')->name('login.repartidor');
Route::get('login-repartidor', 'Auth\LoginController@viewLoginRepartidor')->name('view.login.repartidor');

Route::post('login-admin', 'Auth\LoginController@loginAdmin')->name('login.admin');
Route::get('login-admin', 'Auth\LoginController@viewLoginAdmin')->name('view.login.admin');
Route::get('logout-admin', 'Auth\LoginController@logoutAdmin')->name('logout-admin');


Route::get('/acta/{id}/{date}','AdministratorsController@reporte')->name('reportefinal');
Route::get('/compra/{id}/{bussiness}','AdministratorsController@reporteCompra');
Route::get('/ticket','AdministratorsController@ticket')->name('ticket');
//ticket

Route::group(['namespace'=> 'Deliverier', 'as' => 'Deliverier.','middleware' => 'auth_repartidor'], function() {
    //Repartidor-modulo
    Route::get('/admin/repartidor/logout', 'DeliverierController@logout')->name('logout-repartidor');
    Route::get('/admin/repartidor/mis-pedidos', 'ProtocoloController@index');
    Route::post('/admin/repartidor/subirProtocolo','ProtocoloController@upProtocolo');
    Route::get('/admin/repartidor/recepciones/{recepcion}', 'MyReceptionController@index');
    Route::get('/admin/repartidor/recepciones/realizado/{pedido}/{id}', 'MyReceptionController@changeAccomplished');
    Route::get('/admin/repartidor/recepciones/anulado/{pedido}/{id}', 'MyReceptionController@changeCanceled');
    Route::get('/admin/repartidor/recepciones/proceso/{pedido}/{id}', 'MyReceptionController@changeProcess');
    Route::get('/admin/repartidor/ver-mapa/{id}', 'MyReceptionController@showMap');
});
Route::group([  'namespace'=> 'Frontend', 'as'=> 'Frontend.' ], function() {
    //Route::get('/facturation/{id}','CheckoutController@showcheckout');
    Route::get('/facturation','CheckoutController@showcheckout');
    Route::post('/sign-in', 'CostumerController@signIn');
    Route::post('/sign-up', 'CostumerController@signUp');
    Route::get('/logout-costumer','DeliveryController@logout')->name('logout-costumer');

    Route::get('/mi-perfil', 'CostumerController@profile'); //Diego
    Route::get('/mi-perfil/{id}', 'CostumerController@myPedidos');
    Route::get('/mi-perfil/{id}/talk', 'CostumerController@talk');

    Route::get('/chat', 'ChatController@chat');
    Route::get('/api-web/v1/orders/one/{id}', 'ChatController@one')->name('one.order');
    Route::post('/api-web/v1/messages/create', 'ChatController@create')->name('message.create');

    Route::get('/mi-perfil-negocios', 'CostumerController@listPending');
    Route::get('/mi-perfil-misNegocios', 'CostumerController@listBussiness');
    Route::post('/mi-perfil-actualizar', 'CostumerController@updateProfile');
    Route::get('/mi-perfil-cancelar', 'CostumerController@ProcesarDevolucion');
    Route::post('/cliente/subirComentario', 'CostumerController@upComment');
    Route::get('/cliente/eliminarComentario', 'CostumerController@deleteComment');
    Route::get('/cliente/validarOpinion', 'CostumerController@validationOpinion');
    Route::get('/categorias', 'CostumerController@searchCategories');
    Route::get('/negocios', 'CostumerController@searchBusiness');

    Route::get('/', 'DeliveryController@index');
    Route::post('/list-companies', 'DeliveryController@companies');
    //Route::get('/mapa', 'MapController@index');
    Route::get('/restaurant','ListRestController@index')->name('restaurant');

    Route::get('/restaurant/{id}','DetailRestController@index')->name('restaurant.detail');
    //Route::get('/checkout', 'CheckoutController@index')->name('checkout');
    Route::get('/list-restaurant', 'MapController@list');
    Route::get('category4','ListRestController@getCategory4');
    Route::get('category6','ListRestController@getCategory6');
    Route::get('restaurante','ListRestController@getrestaurante');
    Route::get('/porcentaje','CostumerController@porcentaje');
    //Route::get('/restaurant/{slug}/{id}','ListRestController@index');
    Route::get('/resultados/{userSlug}/{userId}/{productSlug}/{productId}','ListRestController@index');

    Route::get('/checkout','CheckoutController@index');
    Route::post('/checkouts','CheckoutController@checkout');

    //Route::get('/restaurant/{slug}/{id}','ListRestController@index');
    Route::get('/change','ListRestController@change')->name('change');
    Route::get('/card','CheckoutController@card');
    Route::get('/evaluation','CostumerController@evaluation');

    //nueva interfaz
    Route::get('/search','DetailRestController@searchCategory')->name('search');

    Route::get('/searchs/{id}','DetailRestController@searchCategorys')->name('searchs');

    Route::get('/word','DetailRestController@searchWord')->name('word');
    Route::get('/words/{id}/{word}','DetailRestController@searchWords')->name('words');

    Route::get('/list','DetailRestController@list')->name('list');
    Route::get('/listado/{id}','DetailRestController@listado')->name('listado');

    Route::get('/mapa','SearchController@index');
    Route::get('/get-products','SearchController@products')->name('get-products');
    Route::get('/get-products/{datos}','SearchController@selected')->name('get-products-selected');
    Route::get('/department-one','SearchController@departmentOne')->name('params');
    Route::post('/search-companies','SearchController@searchProduct');
    Route::post('/search-category','SearchController@searchCategory');
    Route::post('/slug', 'DeliveryController@redirectTo');
    Route::get('/company','DeliveryController@company');
    Route::get('/resultados/{slug}/{id}', 'MapController@index');
    Route::get('/resultados/{slug}/{id}/sucursales', 'MapController@sucursales');

    Route::post('/filter-products','Map@filterProduct');
    Route::post('/search-product','MapController@searchProduct');
    Route::get('/search-product-all','MapController@searchProductAll');

    Route::post('/filter-province','DeliveryController@filterProvincia');
    Route::post('/filter-district','DeliveryController@filterDistrito');
    Route::get('/provincia','CheckoutController@searchProvincia');
    Route::get('/distrito','CheckoutController@searchDistrito');
    Route::get('/ubicacion','CheckoutController@searchUbicacion');

    Route::get('/qualification','ListRestController@qualification');
    Route::get('/like','ListRestController@like');

    Route::get('/resultados','ResultController@index');
    Route::get('/search-result','ResultController@productos')->name('search_productos');

    Route::get('/resultados-companies','ResultController@searchCompanies');
    Route::get('/name-companies','ResultController@searchName');
    Route::get('/all-companies','ResultController@allCompanies');

    Route::get('/search-department' , 'ResultController@searchDepartment');
    Route::get('/list-sucursales' , 'MapController@searchSucursales');

    Route::get('/visa' , 'CheckoutController@viewVisaDevelopment');
    Route::post('/visa-developer' , 'CheckoutController@VisaDevelopment');

    Route::get('/admin/pruebaMercado', 'CheckoutController@MercadoPago');
    Route::post('/procesar_pago', 'CheckoutController@ProcesarPago');
    Route::get('/resume','CheckoutController@resume')->name('resume');

    // Route::get('/resume','CheckoutController@resume')->name('resume');
    Route::get('/tax', 'TaxController@index');
    Route::get('/tax/search', 'TaxController@showTax');

    Route::get('/payment/pay', 'PaymentController@payTax');

    Route::get('/paypal-prueba', 'CheckoutController@paypalPrueba');
});
Route::group(['namespace'=> 'Admin', 'as' => 'Admin.','middleware' => 'auth_admin'], function() {
    Route::get('/superadmin','HomeController@index');
    Route::get('/superadmin/categoria','HomeController@list')->name('superadmin.categoria.list');
    Route::get('/superadmin/categoria/nuevo','HomeController@create');
    Route::get('/superadmin/categoria/editar/{id}','HomeController@edit');
    Route::post('/superadmin/business/editar/save/{id}','HomeController@update');
    Route::post('/superadmin/business/create','HomeController@store');
    Route::get('/superadmin/perfil','HomeController@profile');
    Route::post('/superadmin/edit-profile','HomeController@profileEdit');
    Route::post('/superadmin/password','HomeController@password');
    Route::get('/superadmin/categoria/activar/{id}', 'HomeController@isActive')->name('active');

    //TransactionController-Diego
    Route::get('/superadmin/transacciones','TransactionController@transaction');
    Route::get('/superadmin/transacciones/{id}','TransactionController@transactionDetails');
    Route::get('/superadmin/transferir','TransactionController@createTransaction');
    Route::get('/superadmin/transferir-detalle/{monto}/{id}','TransactionController@createTransactionDetails');
    Route::get('/superadmin/transferir-todo','TransactionController@createTransactionAll');

    //ConfigurationController-Diego
    Route::get('/superadmin/configuracion','ConfigurationController@index');
    Route::get('/superadmin/configuration/porcentaje-actualizar','ConfigurationController@companyPercentageUpdate');






});
Route::group(['namespace'=> 'Backend', 'as' => 'Backend.','middleware' => 'auth_user'], function() {

    //JHON--USER
    //Route::post('/admin/profile/edit/{id}','UserController@update')->name('profile-update');
    Route::post('/api-reniec', 'UserController@reniec');
    Route::get('/photos','UserController@photos');
    Route::post('admin/filter-province','UserController@filterProvincia');
    Route::post('admin/filter-district','UserController@filterDistrito');

    Route::get('/profile-edit','UserController@update')->name('profile-update');
    Route::post('/admin/profile/edit/ubication','UserController@UpdateUbication')->name('profile-ubication');
    Route::get('/days','UserController@UpdateDays')->name('profile-days');
    Route::post('/galery','UserController@UploadPhotos')->name('profile-gallery');
    Route::get('/galeria','UserController@galeriaprueba');
    Route::get('/gallery/delete','UserController@gallerydelete');
    Route::get('/state','UserController@state');
    //VEHICLE
    Route::get('/admin/vehicle','VehicleController@index');
    Route::get('/admin/vehicle/edit/{id}','VehicleController@editvehicle');
    Route::get('/admin/vehicle/new','VehicleController@newvehicle');
    Route::post('/admin/vehicle/new/save','VehicleController@newvehiclesave');
    Route::post('/admin/vehicle/edit/save/{id}','VehicleController@updatevehicle');
    Route::get('/admin/vehicle/delete/{id}','VehicleController@deletevehicle');
    Route::get('/admin/vehicle/guia','VehicleController@guide');

    Route::get('/admin/profile/gallery','UserController@Gallery');
    Route::get('/admin/profile/gallery/delete/{image}','UserController@deletePhoto')->name('delete-gallery');
    Route::get('/admin/profile','UserController@index')->name('profile');
    Route::post('/admin/profile/edit','UserController@update')->name('profile-update');


    //index
    Route::get('/admin', 'DashboardController@index')->name('dashboard');
    Route::get('/admin/productos', 'ProductController@index');
    Route::get('/admin/clasificaciones', 'CategoryController@index');
    Route::get('/admin/carta', 'letterController@index');
    Route::get('/admin/restaurant', 'restaurantController@index');
    Route::get('/admin/carta', 'letterController@index');

    // PLatos-Diego
    Route::get('/admin/productos','ProductController@index');
    Route::get('/admin/productos/crear','ProductController@createDish');
    Route::post('/admin/productos/subirPlato','ProductController@upDish');
    Route::get('/admin/productos/editar/{id}','ProductController@editDish');
    Route::post('/admin/productos/actualizar','ProductController@updateDish');
    Route::get('/admin/productos/eliminar/{id}','ProductController@deleteDish');
    Route::post('/admin/productos/subirAtributo','ProductController@upAttribute');
    Route::get('/admin/productos/eliminarAtributo','ProductController@deleteAttribute');
    Route::get('/admin/productos/buscarAtributo','ProductController@showAttribute');
    Route::get('/admin/productos/buscarVariacion','ProductController@showVariations');
    Route::get('/admin/productos/subirVariacion','ProductController@showVariation');
    Route::post('/admin/productos/guardarVariacion','ProductController@upVariation');
    Route::get('/admin/productos/eliminarVariacion','ProductController@deleteVariacion');
    Route::get('/admin/productos/guia','ProductController@guide');
    Route::get('/admin/productos/subirExcel','ProductController@upExcel');
    Route::post('/admin/productos/registrarExcel','ProductController@registerExcel');
    Route::get('/admin/productos/bajarExcel','ProductController@downExcel');
    Route::post('/admin/productos/subirDropzone','ProductController@upDropzone');
    Route::get('/admin/productos/eliminarFileDropzone','ProductController@deleteFileDropzone');
    Route::get('/admin/productos/mostrarFilesDropzone','ProductController@showFilesDropzone');
    Route::get('/admin/productos/validarGaleria','ProductController@validateFileDropzone');
    Route::get('/admin/productos/validarVariacion','ProductController@validateVariation');
    Route::get('/admin/productos/validarAtributo','ProductController@validateAttribute');

    // Clasificaciones
    Route::get('/admin/clasificaciones', 'CategoryController@index');
    Route::get('/admin/clasificaciones/nuevaClasificacion','CategoryController@createClassification');
    Route::post('/admin/clasificaciones/subirClasificacion','CategoryController@upClassification');
    Route::get('/admin/clasificaciones/editarClasificacion/{id}','CategoryController@editClassification');
    Route::post('/admin/clasificaciones/actualizar/{id}','CategoryController@updateClassification');
    Route::get('/admin/clasificaciones/eliminar','CategoryController@deleteClassification');
    Route::get('/admin/clasificacion/guia', 'CategoryController@guide');
    Route::get('/admin/clasificacion/searchClasificacion', 'CategoryController@searchClasificacion');
    Route::get('/admin/clasificacion/upSearchClasificacion', 'CategoryController@upSearchClasificacion');

  // Recepciones
    Route::get('/admin/recepciones/{recepcion}', 'ReceptionController@index');
    Route::get('/admin/recepciones/realizado/{pedido}/{id}', 'ReceptionController@changeAccomplished');
    Route::get('/admin/recepciones/anulado/{pedido}/{id}', 'ReceptionController@changeCanceled');
    Route::get('/admin/recepciones/proceso/{pedido}/{id}', 'ReceptionController@changeProcess');
    Route::get('/admin/asignar-repartidor', 'ReceptionController@chooseDeliverier');
    Route::get('/admin/recepciones/ver-mapa/{id}', 'ReceptionController@showMap');
    Route::get('/admin/recepcion/guia', 'ReceptionController@guide');
    // Carta
    Route::get('/admin/clasificaciones/ordenarClasificacion','CategoryController@orderClassification');
    Route::post('/admin/clasificaciones/subirOrden','CategoryController@upOrderClassification');
    // Route::get('/admin/carta', 'CartController@index');
    // Route::get('/admin/subir-carta', 'CartController@upCart');
    // Route::get('/admin/eliminar-carta', 'CartController@deleteCart');
    // Route::get('/admin/prueba', 'ReceptionController@prueba');
    // Route::get('/admin/eliminar-carta', 'CartController@deleteCart');
    // Repartidor
    Route::get('/admin/repartidores', 'DeliverierController@index');
    Route::get('/admin/repartidores/nuevo-repartidor', 'DeliverierController@createDeliverier');
    Route::post('/admin/repartidores/subir-repartidor','DeliverierController@upDeliverier');
    Route::get('/admin/repartidores/editarDeliverier/{id}', 'DeliverierController@editDeliverier');
    Route::get('/admin/repartidores/eliminarDeliverier/{id}', 'DeliverierController@deleteDeliverier');
    Route::post('/admin/repartidores/actualizarDeliverier/{id}', 'DeliverierController@updateDeliverier');
    Route::get('/admin/repartidores/guia', 'DeliverierController@guide');

    // Sucursales
      Route::get('/admin/sucursales', 'BranchController@index');
      Route::post('/admin/sucursales/subir-sucursal', 'BranchController@upBranch');
      Route::get('/admin/sucursales/mostrar-sucursal', 'BranchController@showBranch');
      Route::get('/admin/productos/eliminarSucursal', 'BranchController@deleteBranch');

    //Mercado Pago
    Route::get('/admin/validacion-mercado-pago', 'PaidMarketController@index');
    Route::get('/admin/validacion-mercado-pago/permitido', 'PaidMarketController@permission');
    Route::get('/admin/validacion-mercado-pago/generar-credenciales', 'PaidMarketController@credential');
    Route::get('/admin/validacion-mercado-pago/actualizar-credenciales', 'PaidMarketController@updateCredential');

    //Reporte Calificacion Vendedores
    Route::get('/admin/calificador', 'CalificationController@index');

    //Reporte Vacunas
    Route::get('/admin/vaccine', 'CalificationController@showVaccine');

    Route::get('/admin/prueba', 'ReceptionController@prueba');
    Route::get('/perfil', 'DeliveryController@profile');


});
