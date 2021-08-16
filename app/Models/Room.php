<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Room extends Model
{
    use HasFactory;
    protected $table='rooms';
    protected $guarded = [];
    public $fillable = [
        'room_no', 'image', 'floor', 'price', 'detail'
    ];
    public function room_services(){
        return $this->hasMany(Room_service::class,'room_id');
    }
    public function services(){
        return $this->belongsToMany(Service::class,'room_services','room_id','service_id');
    }
}
