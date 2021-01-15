<?php
declare(strict_types=1);

namespace Work\Models;

use \Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'Books';
    protected $fillable = ['user_id', 'name', 'author', 'publish_year'];
}
