<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Referral extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'referrals';

    /**
     * @var string[]
     */
    protected $fillable = [
        'email',
        'referral_code',
        'referrer_user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userReferrer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referrer_user_id', 'id');
    }
}
