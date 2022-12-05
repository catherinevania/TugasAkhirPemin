<?php



/** @var \Laravel\Lumen\Routing\Router $router */

use App\Models\Mahasiswa;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
	return Mahasiswa::with('matakuliah')->get();
});
$router->group(['prefix' => 'auth'], function () use ($router) {
	$router->post('/register', ['uses' => 'MahasiswaController@register']);
	$router->post('/login', ['uses' => 'MahasiswaController@login']);
});

$router->group(['prefix' => 'mahasiswa'], function () use ($router) {
	$router->get('/', ['uses' => 'MahasiswaController@getAllMahasiswas']);
	$router->get('/profile', ['middleware' => 'jwt.auth', 'uses' => 'MahasiswaController@getByToken']);
	$router->get('/{nim}', ['uses' => 'MahasiswaController@getMahasiswaByNIM']);
	$router->post('/{nim}/matakuliah/{mkId}', ['uses' => 'MahasiswaController@addMatkulToMahasiswa']);
	$router->put('/{nim}/matakuliah/{mkId}', ['uses' => 'MahasiswaController@deleteMatkulMahasiswa']);

});

$router->get('/prodi', ['uses' => 'ProdiController@getAllProdis']);
$router->get('/matakuliah', ['uses' => 'MatakuliahController@getAllMatkul']);