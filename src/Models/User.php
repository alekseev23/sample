<?php
declare(strict_types=1);

namespace Work\Models;

use \Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "Users";
    protected $fillable = ["name"];
}
