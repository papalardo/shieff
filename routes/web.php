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

//Init
Route::get('/', 'HomeController@index');


/*
* Routes CRUD Cart
* and Resource Pedido
*/
Route::get('/api/cart/all', 'PedidosController@allItemCart');
Route::post('pedido/addItemCart', 'PedidosController@addItemCart');
Route::delete('pedido/delItemCart/{id}', 'PedidosController@delItemCart');
Route::get('meusPedidos', 'PedidosController@meusPedidos');
Route::resource('pedido', 'PedidosController');

/*
* Routes Login para Redes Sociais
*/
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callbackFacebook', 'SocialAuthFacebookController@callback');
Route::get('/redirectInstagram', 'SocialAuthInstagramController@redirect');
Route::get('/callbackInstagram', 'SocialAuthInstagramController@callback');

/*
*  AUTH Routes
*/
Auth::routes();


/*
* API GET ALL IN JSON
*/
Route::get('/api/produtos/all', 'Admin\ProdutosController@jsonItens');
Route::get('/categoria/all', 'Admin\CategoriaProdutosController@allInJson');

/*
* FrontEnd Cliente
*/


Route::resource('userpefil', 'PerfilUsuarioController');
#Route::resource('cart', 'CarrinhoController');
//Route::resource('pedido', 'PedidosProdutosController');


/*
* RESOURCEs CRUDS ADMIN
*/
Route::middleware(['auth'])->prefix('admin')->namespace('Admin')->group(function(){

  Route::resource('artigos', 'ArtigosController')->middleware('can:autor');
  Route::resource('usuarios', 'UsuariosController');
  Route::resource('autores', 'AutoresController')->middleware('can:eAdmin');
  Route::resource('adm', 'AdminController')->middleware('can:eAdmin');
  Route::resource('produtos', 'ProdutosController');
  Route::resource('categoria', 'CategoriaProdutosController');
});


Route::middleware(['auth'])->prefix('dashboard/pedidos')->namespace('Dashboard')->group(function(){
  Route::get('aberto', 'PedidosController@aberto');
  Route::get('pronto', 'PedidosController@pronto');
  Route::get('jsonCardAberto/{status?}', 'PedidosController@jsonCardAberto');
  Route::get('mudarEstado/{estado?}/{id?}', 'PedidosController@mudarEstado');
});


Route::get('/home', 'HomeController@index')->name('home');


/*
* @Testes
*/

Route::get('caixa', function(){
        $produtos = \App\Produto::with('categoria')
        ->get()->toJson();
        $categorias = \App\CategoriaProduto::all()->toJson();
  return view('dashboard.caixa.index', compact('produtos', 'categorias'));
});
