<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Expense;

class ExpensePayment extends Model
{
    protected $fillable = [
        'expense_id',
        'month',
        'year',
    ];
    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }
}
