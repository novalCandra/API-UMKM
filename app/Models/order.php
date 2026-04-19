<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $guarded = [];

    public function users()
    {
        return parent::belongsTo(User::class, "user_id");
    }

    public function barangs()
    {
        return parent::belongsToMany(order::class, "order_barangs", "id_order", "id_barang");
    }
}
