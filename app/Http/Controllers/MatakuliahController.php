<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;

class MatakuliahController extends Controller
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

	public function getAllMatkul()
	{
		return response()->json([
			'message' => 'Berhasil menampilkan mata kuliah',
			'matakuliah' => Matakuliah::all()
		]);
	}
}
