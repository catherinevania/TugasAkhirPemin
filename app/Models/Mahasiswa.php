<?php

namespace App\Models;

use App\Models\Prodi;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var string[]
	 */
	protected $fillable = [
		'nim', 'nama', 'angkatan', 'password', 'id_prodi', 'token'
	];
	protected $primaryKey = 'nim';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var string[]
	 */
	protected $hidden = [];

	public function prodi()
	{
		return $this->belongsTo(Prodi::class, 'id_prodi', 'id');
	}

	public function matakuliahs()
	{
		return $this->belongsToMany(Matakuliah::class, 'mahasiswa_matakuliah', 'mhsNim', 'mkId');
	}
}
