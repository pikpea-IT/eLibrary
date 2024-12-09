<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    // protected $with = 'permissions';

    public $table = 'roles';

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    // protected function serializeDate(DateTimeInterface $date)
    // {
    //   return $date->format('Y-m-d H:i:s');
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
