<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'amount_per_patient'
    ];
    
    public function create_new($data)
    {
        $save = new self;
        $save->name = $data['name'];
        $save->amount_per_patient = $data['amount_per_patient'];
        $save->save();
        return $save;
    }
}
