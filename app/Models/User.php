<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'phone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function create_admin($data)
    {
        $save = new self;
        $save->name = $data['name'];
        $save->email = $data['email'];
        $save->username = $data['username'];
        $save->phone_number = $data['phone_number'];
        $save->gender = $data['gender'];
        $save->role = 'Admin';
        $save->password = Hash::make($data['password']);
        $save->save();
        return $save;
    }

    public function create_doctor($data)
    {
        $save = new self;
        $save->name = $data['name'];
        $save->email = $data['email'];
        $save->username = $data['username'];
        $save->phone_number = $data['phone_number'];
        $save->gender = $data['gender'];
        $save->speciality_id = $data['speciality_id'];
        $save->role = 'Doctor';
        $save->password = Hash::make($data['password']);
        $save->save();
        return $save;
    }

    public function create_staff($data)
    {
        $save = new self;
        $save->branch_id = $data['branch_id'];
        $save->name = $data['name'];
        $save->email = $data['email'];
        $save->username = $data['username'];
        $save->phone_number = $data['phone_number'];
        $save->gender = $data['gender'];
        $save->role = 'Staff';
        $save->password = Hash::make($data['password']);
        $save->save();
        return $save;
    }

    public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'speciality_id')->withDefault();
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id')->withDefault();
    }
}
