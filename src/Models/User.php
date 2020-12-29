<?php

namespace Work\Model;
use \Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $table = "Users";
    protected $fillable = array("name");

}
