<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\LevelModel;
use Illuminate\Foundation\Auth\User as userAuthentication;

class UserModel extends userAuthentication 
{
    use HasFactory;
    
    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    
    protected $fillable = ['level_id', 'username', 'nama','password'];
    
    public function level(): BelongsTo
    {
        // return $this->belongsTo(LevelModel::class);
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

}