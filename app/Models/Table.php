<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Table extends Model
{
    use HasFactory, HasUuids;
    

    // The table associated with the model (optional if the model name matches the table name)
    protected $table = 'tables';

    // The attributes that are mass assignable
    protected $fillable = [
        'table_number',
        'floor_number',
        'total_seat',
        'hourly_price',
        'status',
        'type',
    ];
    protected $casts = [
        'hourly_price' => 'decimal:2',
    ];
    // protected $keyType = 'string'; 
    // public $incrementing = false;
}
