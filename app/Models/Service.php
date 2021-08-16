<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table='services';
    public $fillable = [
        'name', 'icon'
    ];
    public function room_service(){
        return $this->hasMany(Room_service::class,'service_id');
    }
    public function rooms(){
        return $this->belongsToMany(Room::class,'room_services','service_id','room_id');
    }
}
