<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Audit;

class Audits extends Model implements Audit
{
    use \OwenIt\Auditing\Audit;

    protected $table = 'audits';
    protected $fillable =[
        'user_type',
        'user_id',
        'event',
        'auditable_type',
        'auditable_id',
        'old_values',
        'new_values',
        'url',
        'ip_address',
        'user_agent',
        'tags'
    ];

    protected $guarded = [];

    protected $casts = [
        'old_values'   => 'array',
        'new_values'   => 'array',
        'auditable_id' => 'integer',
    ];

}
