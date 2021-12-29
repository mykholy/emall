<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed expired_at
 * @property mixed description
 * @property mixed name
 * @property mixed started_at
 * @property mixed user_id
 * @method static orderBy(string $string, string $string1)
 * @method static find($id)
 */
class Gift extends Model
{
    use hasFactory;


    protected $fillable = [
        'name', 'description', 'is_activate', 'started_at', 'expired_at', 'user_id'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(GiftProduct::class,'gift_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }



}
