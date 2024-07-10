<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    public function color()
    {
        return $this->belongsTo(Color::class,'color_id');
    }
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
}
