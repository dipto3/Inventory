<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor',
        'first_name',
        'last_name',
        'email',
        'phone',
        'userId',
        'status',
        'zipCode',
        'emergencyContact_person',
        'emergencyContact_phone',
        'emergencyContact_address',
    ];
}
