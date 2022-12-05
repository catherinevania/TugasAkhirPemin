<?php

namespace App\Http\Controllers;

use App\Models\Prodi;

class ProdiController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	public function getAllProdis()
	{
		return response()->json([
			'message' => 'Berhasil menampilkan prodi',
			'data' => Prodi::all()
		]);
	}
}
