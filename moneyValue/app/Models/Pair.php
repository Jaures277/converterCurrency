<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pair extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'currency_id_from',
        'currency_id_to',
        'rate',
        'exchange_number',
    ];

    public function currencyFrom(){
        return $this->belongsTo(Currency::class,'currency_id_from');
    }
    public function currencyTo(){
        return $this->belongsTo(Currency::class,'currency_id_to');
    }
    public function convert(){
        return $this->hasOne(Convert::class);
    }
}
