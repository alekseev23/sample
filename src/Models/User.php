<?php
declare(strict_types=1);

namespace Work\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Работа с таблицей Users
 * @package Work\Models
 */
class User extends Model
{
    /**
     * @var string $table
     */
    protected $table = 'Users';

    /**
     * @var string[]
     */
    protected $fillable = ['name'];
}
