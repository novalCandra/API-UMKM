<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orders()
    {
        return parent::belongsToMany(order::class, "order_barangs", "id_barang", "id_order");
    }

    public function categorie()
    {
        return parent::belongsTo(category::class, "id_categorie");
    }
}
