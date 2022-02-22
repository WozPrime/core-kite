<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceModel extends Model
{
    use HasFactory;
    protected $table = 'finance';
    protected $fillable =[
        'name_finance',
        // 'code_finance',
        'date_finance',
        'category_finance',
        'type_finance',
        'nominal_finance',
        'balance_finance',
        'nota_finance',
        'inout_finance',
        'detail_finance',
    ];
}
