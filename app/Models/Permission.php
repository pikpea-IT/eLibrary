<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'permissions';

    protected $fillable = [
        'group',
        'title',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // protected function serializeDate(DateTimeInterface $date)
    // {
    //   return $date->format('Y-m-d H:i:s');
    // }
}
