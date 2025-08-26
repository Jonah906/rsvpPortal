<?php

namespace App\Models;

use App\Models\User;
use App\Models\Paymentcycle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;
    protected $table = 'subscriptions';
    protected $guarded = [
        'id',
    ];

    static public function getRecord()
    {
      return self::with(['users', 'paymentcycles', 'categories'])->where('status', 1)->get();
    }

    static public function getSingle($id)
    {
      return self::find($id);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user');
    }

    public function paymentcycles()
    {
        return $this->belongsTo(Paymentcycle::class, 'payment_cycle');
    }
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category');
    }
}
