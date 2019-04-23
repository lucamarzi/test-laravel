<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
    public function welcome($name='', $lastname = '', $age = '') {
        $str = '<h1>Hello World ' . $name ." ". $lastname;
        if($age != '')
            $str .= " you are " .$age. " year old";
        $str .= "</h1>";
        return $str;
    }
}
