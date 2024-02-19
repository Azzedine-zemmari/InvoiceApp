<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable =[
        'number',
        'customer_id',
        'date',
        'due_date',
        'reference',
        'terms_and_condition',
        'sub_total',
        'discount',
        'total',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
