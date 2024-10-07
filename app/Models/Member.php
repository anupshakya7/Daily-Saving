<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function savings()
    {
        return $this->hasOne(Saving::class);
    }

    public function calculateTotalAmount()
    {
        $today = Carbon::now();

        $daysDifference = $today->diffInDays($this->join_date);
        $totalDays = $daysDifference + 1;

        $totalamount = $totalDays * $this->daily_balance;

        return $totalamount;
    }
}
