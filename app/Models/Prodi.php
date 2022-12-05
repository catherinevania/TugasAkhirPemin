<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var string[]
	 */
	protected $fillable = [
		'id','nama'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var string[]
	 */
	protected $hidden = [];

	public function mahasiswas()
	{
		return $this->hasMany(Mahasiswa::class, 'id_prodi', 'id');
	}
}
