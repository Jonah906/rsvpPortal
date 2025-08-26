<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Tribute extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'tributes';
    protected $fillable = [
      'name',
      'title',
      'tribute_content',
    ];

    static public function getRecord()
    {
      return self::select('*')
        ->where('deleted_at', null)
        ->orderBy('id', 'desc')
      ->get();
    }

    static public function getSingle($id)
    {
      return self::find($id);
    }

}
