<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';
    protected $guarded = [
      'id',
    ];

    static public function getRecord()
    {
      return self::with('users')->where('status', 1)->get();
    }

    static public function getSingle($id)
    {
      return self::find($id);
    }

    public function users() {
      return $this->belongsTo(User::class, 'createdBy');
    }
}
