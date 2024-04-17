<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PenjualanModel extends Model
{
    use HasFactory;

    protected $table = 't_penjualan';
    protected $primaryKey = 'penjualan_id';

    protected $guarded = 'penjualan_id';

    public function penjualanDetail(): HasOne
    {
        return $this->hasOne(PenjualanDetailModel::class, 'penjualan_id', 'penjualan_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(userModel::class, 'user_id', 'user_id');
    }
}
