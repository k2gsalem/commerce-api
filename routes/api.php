<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

    $api->group(['middleware' => ['throttle:60,1', 'bindings'], 'namespace' => 'App\Http\Controllers'], function ($api) {

        $api->get('ping', 'Api\PingController@index');
        $api->post('member/register', 'Api\Users\UsersController@store');
        $api->get('assets/{uuid}/render', 'Api\Assets\RenderFileController@show');

        $api->group(['middleware' => ['auth:api'], ['role:Administrator']], function ($api) {

            $api->group(['prefix' => 'users'], function ($api) {
                $api->get('/', 'Api\Users\UsersController@index');
                $api->post('/', 'Api\Users\UsersController@store');
                $api->get('/{uuid}', 'Api\Users\UsersController@show');
                $api->put('/{uuid}', 'Api\Users\UsersController@update');
                $api->patch('/{uuid}', 'Api\Users\UsersController@update');
                $api->delete('/{uuid}', 'Api\Users\UsersController@destroy');
               

            });
            $api->group(['prefix' => 'profile'], function ($api) {
                $api->resource('/userAddress', 'Api\Profile\UserAddressController');
            });
            $api->group(['prefix' => 'orders'], function ($api) {
                $api->resource('/userOrder', 'Api\Order\UserOrderController');
                $api->resource('/userOrderItem', 'Api\Order\UserOrderItemController');
            });
            $api->group(['prefix' => 'roles'], function ($api) {
                $api->get('/', 'Api\Users\RolesController@index');
                $api->post('/', 'Api\Users\RolesController@store');
                $api->get('/{uuid}', 'Api\Users\RolesController@show');
                $api->put('/{uuid}', 'Api\Users\RolesController@update');
                $api->patch('/{uuid}', 'Api\Users\RolesController@update');
                $api->delete('/{uuid}', 'Api\Users\RolesController@destroy');
            });

            $api->get('permissions', 'Api\Users\PermissionsController@index');

            $api->group(['prefix' => 'me'], function ($api) {
                $api->get('/', 'Api\Users\ProfileController@index');
                $api->put('/', 'Api\Users\ProfileController@update');
                $api->patch('/', 'Api\Users\ProfileController@update');
                $api->put('/password', 'Api\Users\ProfileController@updatePassword');
                
            });

            $api->group(['prefix' => 'assets'], function ($api) {
                $api->post('/', 'Api\Assets\UploadFileController@store');
                $api->delete('/{uuid}', 'Api\Assets\UploadFileController@destroy');
            });
            $api->resource('confStatus', 'Api\Config\ConfStatusController');
            $api->resource('confOrderType', 'Api\Config\ConfOrderTypeController');
            $api->resource('confPaymentStatus', 'Api\Config\ConfPaymentStatusController');
            $api->resource('confSupplierCat', 'Api\Config\ConfSupplierCatController');
            $api->resource('confVendorCat', 'Api\Config\ConfVendorCatController');
            $api->resource('confOrderStatus', 'Api\Config\ConfigOrderStatusController');
            $api->resource('prodCat', 'Api\Config\ProdCatController');
            $api->resource('prodSubCat', 'Api\Config\ProdSubCatController');
            $api->resource('vendors', 'Api\Vendor\VendorController');
            $api->resource('vendorStores', 'Api\Vendor\VendorStoreController');
            $api->resource('suppliers', 'Api\Vendor\SupplierController');

            $api->resource('item', 'Api\Catalogue\ItemController');
            $api->resource('itemVariant', 'Api\Catalogue\ItemVariantController');
            $api->resource('itemVariantGroup', 'Api\Catalogue\ItemVariantGroupController');                                                             
            $api->resource('stockMaster', 'Api\Stock\StockMasterController');
            $api->resource('stockTracker', 'Api\Stock\StockTrackerController');
            

            $api->group(['prefix' => 'member'], function ($api) {
                $api->get('/getAddress','Api\Profile\UserAddressController@getAddress');
                $api->group(['prefix' => 'me'], function ($api) {                    
                    $api->get('/', 'Api\Users\ProfileController@index');
                    $api->put('/', 'Api\Users\ProfileController@update');
                    $api->patch('/', 'Api\Users\ProfileController@update');
                    $api->put('/password', 'Api\Users\ProfileController@updatePassword');
                });
                
            });
           // $api->put('/addToCart/{cart}', 'Api\CartManager\AddToCartController@update');
            //$api->resource('cart', 'Api\CartManager\CartController');
            $api->get('fetchCart', 'Api\CartManager\CartController@fetchCart');
            $api->put('addToCart/{user}', 'Api\CartManager\CartController@update');
            //$api->get('fetchCart/{user}', 'Api\CartManager\CartController@fetchCart');
            $api->resource('cartItem', 'Api\CartManager\CartItemController');
            $api->resource('cartItemVariant', 'Api\CartManager\CartItemVariantController');
        });

        $api->group(['prefix' => 'member'], function ($api) {

            $api->get('/confStatus/{confStatus}', 'Api\Config\ConfStatusController@show');
            $api->get('/confOrderType/{confOrderType}', 'Api\Config\ConfOrderTypeController@show');
            $api->get('/confPaymentStatus/{confPaymentStatus}', 'Api\Config\ConfPaymentStatusController@show');
            
            $api->get('/prodCat', 'Api\Config\ProdCatController@index');
            $api->get('/prodCat/{prodCat}', 'Api\Config\ProdCatController@show');

            $api->get('/prodSubCat', 'Api\Config\ProdSubCatController@index');
            $api->get('/prodSubCat/{prodSubCat}', 'Api\Config\ProdSubCatController@show');

            $api->get('/item', 'Api\Catalogue\ItemController@index');
            $api->get('/item/{item}', 'Api\Catalogue\ItemController@show');

            $api->get('/itemVariant', 'Api\Catalogue\ItemVariantController@index');
            $api->get('/itemVariant/{itemVariant}', 'Api\Catalogue\ItemVariantController@show');

            // $api->get('/stock/{stock}', 'Api\Stock\StockMasterController@show');
            $api->get('/vendor/{vendor}', 'Api\Vendor\VendorController@show');


            $api->get('/search', 'Api\Search\SearchController@search');
        });
    });
});
