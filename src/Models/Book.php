<?php
declare(strict_types=1);

namespace Work\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Работа с таблицей Books
 * @package Work\Models
 */
class Book extends Model
{
    /**
     * @var string $table
     */
    protected $table = 'Books';

    /**
     * @var string[]
     */
    protected $fillable = ['user_id', 'name', 'author', 'publish_year'];
}
