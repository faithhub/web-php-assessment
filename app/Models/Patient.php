<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name',
      'phone_number',
      'date_of_birth',
      'address',
      'gender',
    ];

    public function create($data)
    {
      $save = new self;
      $save->name = $data['name'];
      $save->phone_number = $data['phone_number'];
      $save->date_of_birth = $data['date_of_birth'];
      $save->gender = $data['gender'];
      $save->address = $data['address'];
      $save->save();
      return $save;
    }
}
