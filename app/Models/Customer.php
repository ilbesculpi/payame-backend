<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Builder;

class Customer extends Model
{
    use HasFactory, HasUlids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'full_name',
        'document_id',
        'telephone',
        'email',
        'address',
        'notes'
    ];

    public static function getUserCustomers($user_id) : Builder
    {
        return Self::where(['user_id' => $user_id]);
    }

}

