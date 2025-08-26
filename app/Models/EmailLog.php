<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    use HasFactory;

    protected $table = 'email_log';

    protected $fillable = [
      'contact_email',
      'booking_id',
      'created_at',
      'updated_at',
    ];

    static public function getSingle($id)
    {
        return self::where('id', $id)->first();
    }

}
