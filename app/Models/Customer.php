<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * The accessors to append to the model's array form.
     * @var array
     */
    protected $appends = ['avatar_url'];

    public static function getUserCustomers($user_id)
    {
        return Self::where(['user_id' => $user_id]);
    }

    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=' . urlencode($attributes['full_name'])
        );
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

}

