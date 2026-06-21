<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class WasteStock extends Model
{
    protected $guarded = [];
    public function wasteType() { return $this->belongsTo(WasteType::class); }
}