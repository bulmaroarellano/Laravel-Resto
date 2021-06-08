<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'dni',
        'firstname',
        'lastname',
        'telephone',
        'email',
        'fiscal_code',
        'company_name',
    ];

    protected $searchableFields = ['*'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
