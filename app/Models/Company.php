<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use softDeletes;
    use Timestamp;
    protected $primaryKey="id";
    protected $table="company";
    protected $fillable=[
        'name',
        'organization_number',
        'street_name',
        'house_number',
        'zip_code',
        'country',
        'phone',
        'email',
    ];
}
