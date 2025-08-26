<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSettings extends Model
{
    use HasFactory;

    protected $table = 'email_settings';

    protected $fillable = [
      'email_count',
      'cycle_count',
      'created_at',
      'updated_at',
    ];

    static public function getSingle($id)
    {
        return self::where('id', $id)->first();
    }


    public static function getEmailCounts()
    {
        return self::select('email_count', 'cycle_count')->first();
    }
}
