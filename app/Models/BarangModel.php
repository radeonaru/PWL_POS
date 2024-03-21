<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BarangModel extends Model {
    protected $table = 'm_barang';
    protected $primaryKey = 'barang_id';
}