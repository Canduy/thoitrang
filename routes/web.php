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
// frontend
Route::get('/','HomeController@index');

Route::get('/trang-chu','HomeController@index');
Route::get('/lien-he','HomeController@contact');
Route::get('/search','HomeController@search');
Route::get('/404','HomeController@page_error');

// Danh muc san pham trang chu
Route::get('/danh-muc-san-pham/{category_product_slug}','CategoryProduct@show_category_home');
Route::get('/chi-tiet-san-pham/{product_slug}','ProductController@detail_product');

// backend
Route::get('/Admin', 'AdminController@index');
Route::get('/dash', 'AdminController@showdash');
Route::get('/logout', 'AdminController@logout');
Route::post('/admin-dash', 'AdminController@dash');


// category-product

Route::get('/add-category-product', 'CategoryProduct@add_category_product');
Route::get('/edit-category-product/{category_product_id}', 'CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}', 'CategoryProduct@delete_category_product');
Route::get('/all-category-product', 'CategoryProduct@all_category_product');
Route::get('/unactive-category-product/{category_product_id}', 'CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}', 'CategoryProduct@active_category_product');

Route::post('/save-category-product', 'CategoryProduct@save_category_product');
Route::post('/upload-category-product/{category_product_id}', 'CategoryProduct@update_category_product');

// Brand-product

Route::get('/add-brand-product', 'BrandProdcut@add_brand_product');
Route::get('/edit-brand-product/{brand_product_id}', 'BrandProdcut@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}', 'BrandProdcut@delete_brand_product');
Route::get('/all-brand-product', 'BrandProdcut@all_brand_product');
Route::get('/unactive-brand-product/{brand_product_id}', 'BrandProdcut@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}', 'BrandProdcut@active_brand_product');

Route::post('/save-brand-product', 'BrandProdcut@save_brand_product');
Route::post('/upload-brand-product/{brand_product_id}', 'BrandProdcut@update_brand_product');

// product

Route::get('/add-product', 'ProductController@add_product');
Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
Route::get('/delete-product/{product_id}', 'ProductController@delete_product');
Route::get('/all-product', 'ProductController@all_product');
Route::get('/unactive-product/{product_id}', 'ProductController@unactive_product');
Route::get('/active-product/{product_id}', 'ProductController@active_product');

Route::post('/save-product', 'ProductController@save_product');
Route::post('/upload-product/{product_id}', 'ProductController@update_product');

// slider

Route::get('/add-slider', 'SliderController@add_slider');
Route::get('/edit-slider/{slider_id}', 'SliderController@edit_slider');
Route::get('/delete-slider/{slider_id}', 'SliderController@delete_slider');
Route::get('/all-slider', 'SliderController@all_slider');
Route::get('/unactive-slider/{slider_id}', 'SliderController@unactive_slider');
Route::get('/active-slider/{slider_id}', 'SliderController@active_slider');

Route::post('/save-slider', 'SliderController@save_slider');
Route::post('/upload-slider/{slider_id}', 'SliderController@update_slider');

// tin tức
	
Route::get('/add-new', 'NewController@add_new');
Route::get('/edit-new/{new_id}', 'NewController@edit_new');
Route::get('/delete-new/{new_id}', 'NewController@delete_new');
Route::get('/all-new', 'NewController@all_new');
Route::get('/unactive-new/{new_id}', 'NewController@unactive_new');
Route::get('/active-new/{new_id}', 'NewController@active_new');

Route::post('/save-new', 'NewController@save_new');
Route::post('/upload-new/{new_id}', 'NewController@update_new');

Route::get('/chi-tiet-tin-tuc/{new_id}','NewController@show_detail_new');

// cart 
// Route::post('/save-cart','CartController@save_cart');
Route::post('/add-cart-ajax','CartController@add_cart_ajax');
// Route::post('/update-cart-quantity','CartController@update_cart_quantity');
Route::post('/update-cart','CartController@update_cart');
Route::get('/delete-all-product-cart', 'CartController@delete_all_product_cart');

// Route::get('/show-cart', 'CartController@show_cart');
Route::get('/gio-hang', 'CartController@gio_hang');
// Route::get('/delete-cart/{rowId}', 'CartController@delete_cart');
Route::get('/delete-product-cart/{session_id}', 'CartController@delete_product_cart');

// checkout
Route::get('/login-checkout','CheckoutController@login_checkout');
Route::get('/logout-checkout','CheckoutController@logout_checkout');
Route::post('/add-customer','CheckoutController@add_customer');
Route::post('/login-customer','CheckoutController@login_customer');
Route::post('/order-place','CheckoutController@order_place');
Route::get('/checkout','CheckoutController@checkout');
Route::get('/payment','CheckoutController@payment');
Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer');

Route::post('/select-delivery-home','CheckoutController@select_delivery_home');
Route::post('/caculate-fee','CheckoutController@caculate_fee');
Route::get('/del-fee','CheckoutController@del_fee');
Route::post('/confirm-order','CheckoutController@comfirm_order');



//order
Route::get('/manager-order','OrderController@manager_order');
// Route::get('/manager-order','CheckoutController@manager_order');
Route::get('/delete-order/{order_code}','OrderController@order_code');
Route::get('/view-order/{order_code}','OrderController@view_order');
Route::post('/update-order-qty','OrderController@update_order_qty');
Route::post('/update-qty','OrderController@update_qty');
Route::get('/print-order/{checkout_code}','OrderController@print_order');

 
 // gallery
 Route::get('add-gallery/{product_id}','GalleryController@add_gallery');
 Route::post('select-gallery','GalleryController@select_gallery');
 Route::post('insert-gallery/{pro_id}','GalleryController@insert_gallery');
 Route::post('update-gallery-name','GalleryController@update_gallery_name');
 Route::post('update-gallery','GalleryController@update_gallery');
 Route::post('delete-gallery','GalleryController@delete_gallery');


 // delivery 
  Route::get('/delivery','DeliveryController@delivery');
  Route::post('/select-delivery','DeliveryController@select_delivery');
  Route::post('/insert-delivery','DeliveryController@insert_delivery');
  Route::post('/select-feeship','DeliveryController@select_feeship');
  Route::post('/update-delivery','DeliveryController@update_delivery');


// Attr

Route::match(['get','post'],'/add-attr/{product_id}', 'AttrController@add_attr');
// Route::post('/insert-attr/{product_id}', 'AttrController@insert_attr');s
  Route::get('/get-size','ProductController@get_size');
 