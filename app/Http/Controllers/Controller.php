<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
	public function coba()
	{
		Mahasiswa::with('prodi')->get();
	}
}
