<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderBarang extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orders()
    {
        return parent::belongsTo(order::class, "id_order");
    }
    public function barang()
    {
        return parent::belongsTo(barang::class, "id_barang");
    }
}
