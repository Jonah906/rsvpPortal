<?php

namespace App\Models;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paymentcycle extends Model
{
    use HasFactory;

    protected $table = 'paymentcycles';
    protected $guarded = [
        'id',
    ];

    static public function getRecord()
    {
      return self::with('users')->get();
    }

    static public function getSingle($id)
    {
      return self::find($id);
    }

    public function subscriptions() {
      return $this->hasMany(Subscription::class);
    }

    public function users() {

      return $this->belongsTo(User::class, 'createdBy');

    }

}
