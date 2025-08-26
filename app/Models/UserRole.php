<?php

namespace App\Models;

use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserRole extends Model
{
    use HasFactory;

    
    protected $table = 'user_roles';
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
