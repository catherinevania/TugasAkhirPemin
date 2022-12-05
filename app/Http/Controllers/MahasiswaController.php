<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Firebase\JWT\JWT;

class MahasiswaController extends Controller
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

	public function register(Request $request)
	{
		// $nim = $request->nim;
		// $email = $request->email;
		// $password = Hash::make($request->password);

		$mahasiswa =  Mahasiswa::create([
			'nama' => $request->nama,
			'nim' => $request->nim,
			'id_prodi' => $request->id_prodi,
			"angkatan" => $request->angkatan,
			'password' => Hash::make($request->password)
		]);

		return response()->json([
			'status' => 'Success',
			'message' => 'Mahasiswa berhasil ditambahkan',
		], 200);
	}

	public function login(Request $request)
	{
		$nim = $request->nim;
		$password = $request->password;

		$mahasiswa = Mahasiswa::where('nim', $nim)->first();

		if (!$mahasiswa) {
			return response()->json([
				'status' => 'Error',
				'message' => 'Mahasiswa tidak terdaftar',
			], 404);
		}

		if (!Hash::check($password, $mahasiswa->password)) {
			return response()->json([
				'status' => 'Error',
				'message' => 'Password salah',
			], 400);
		}

		$mahasiswa->token = $this->jwt($mahasiswa); //
		$mahasiswa->save();

		return response()->json([
			'status' => 'Success',
			'message' => 'Login berhasil',
			'data' => [
				'user' => $mahasiswa,
			]
		], 200);
	}

	public function getAllMahasiswas()
	{
		return Mahasiswa::all();
	}

	public function getByToken(Request $request)
	{
		$mahasiswa = $request->mahasiswa;

		return response()->json([
			'status' => 'Success',
			'message' => 'selamat datang ' . $mahasiswa->nama,
		], 200);
	}

	public function getMahasiswaByNIM($nim)
	{
		$mahasiswa = Mahasiswa::where('nim', $nim)->first();

		return response()->json([
			'success' => true,
			'message' => 'Menampilkan semua mahasiswa',
			'data' => [
				'mahasiswa' => [
					'nim' => $mahasiswa->nim,
					'nama' => $mahasiswa->nama,
					'id_prodi' => $mahasiswa->id_prodi,
					'angkatan' => $mahasiswa->angkatan,
					'matakuliah' => $mahasiswa->matakuliahs
				]
			]
		]);
	}

	protected function jwt(Mahasiswa $mahasiswa)
	{
		$payload = [
			'iss' => 'lumen-jwt', //issuer of the token
			'sub' => $mahasiswa->nim, //subject of the token
			'iat' => time(), //time when JWT was issued.
			'exp' => time() + 60 * 60 //time when JWT will expire
		];

		return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
	}

	public function addMatkulToMahasiswa(Request $request)
	{
		$mahasiswa = Mahasiswa::find($request->nim);

		$mahasiswa->matakuliahs()->attach($request->mkId);

		return response()->json([
			'success' => true,
			'message' => 'Matkul berhasil ditambahkan',
		]);
	}

	public function deleteMatkulMahasiswa(Request $request)
	{
		$mahasiswa = Mahasiswa::find($request->nim);

		$mahasiswa->matakuliahs()->detach($request->mkId);

		return response()->json([
			'success' => true,
			'message' => 'Matkul berhasil dihapus',
		]);
	}
}
