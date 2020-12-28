<?php
namespace Controllers;

use Models\User;

class Users {

    public static function create_user ($name) {
        $arr = array(
            "name" => $name
        );
        $user = User::create($arr);
        return $user;
    }

    public static function show_users () {
        $users = User::all();
        return $users;
    }

    public static function show_users_with_parameter ($param) {
        $users = User::where('name','like', $param)->get();
        return $users;
    }

} 