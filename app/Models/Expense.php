<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ExpensePayment;

class Expense extends Model
{

    protected $fillable = [
        'user_id',
        'name',
        'amount',
        'category',
        'due_day',
        'is_recurring',
        'recurring_end_date',    
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments() 
    {
        return $this->hasMany(ExpensePayment::class);
    }

    public function isPaid()
    {
        return $this->payments()
            ->where('month', now()->month)
            ->where('year', now()->year)
            ->exists();
    }
}
