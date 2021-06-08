<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'amount',
        'due_at',
        'paid_at',
        'customer_id',
        'event_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'due_at' => 'date',
        'paid_at' => 'date',
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
