<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\UserRole;
use App\Models\Department;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'phone',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function subscriptions() {

        return $this->hasMany(Subscription::class);
    }

    public function departments()
    {
        return $this->belongsTo(Department::class, 'department');
    }

    public function user_roles() {
        return $this->belongsTo(UserRole::class, 'role_id');
    }

    public static function getAdminList()
    {
       $users = DB::table('users as a')->select('a.id', 'a.fname', 'a.email')->get();

       $arr = [];

        foreach ($users as $index => $user) {
            $arr[] = [
                'sn'    => $index + 1,
                'id'    => $user->id,
                'fname'  => $user->fname,
                'email' => $user->email,
            ];
        }

        return $arr;
    }

    public static function getAttendanceList()
    {
        $results = DB::table('bookings as a')
            ->select('a.name', 'a.email', 'a.phone', 'a.created_at', 'a.ref_tag')
            ->where('a.status', '1')
            ->get();

        $arr = [];
        foreach ($results as $index => $row) {
            $arr[] = [
                'sn'         => $index + 1,
                'name'       => $row->name,
                'email'      => $row->email,
                'phone'      => $row->phone,
                'ref_tag'    => $row->ref_tag,
                'created_at' => $row->created_at,
            ];
        }

        return $arr;
    }

    
}
