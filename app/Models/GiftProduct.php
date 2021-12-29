<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed product_id
 * @property mixed gift_id
 * @method static find($id)
 * @method static where(string $string, string $string1, $user_id)
 */
class GiftProduct extends Model
{
    use HasFactory;


    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function gift(): BelongsTo
    {
        return $this->belongsTo(Gift::class);
    }
}
