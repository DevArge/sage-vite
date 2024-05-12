<?php

namespace App\View\Directives;


class GreetingsDirective
{
    /**
    * Example function Hello for blade directives.
    *
    * @return string
    */
    public static function greetings($name, $lastName)
    {
        // you can define all you logic here and return the result for the blade view
        return 'Hello ' . $name . ' ' . $lastName;
    }
}

