<?php

use Illuminate\Support\HtmlString;

if (!function_exists('disable_autocomplete')) {
    /**
     * Generates an invisible user and password fields to let browsers fill them out instead of the relevant fields.
     *
     * @return \Illuminate\Support\HtmlString
     */
    function disable_autocomplete()
    {
        return new HtmlString('<input style="position:absolute;opacity:0"><input type="password" style="position:absolute;opacity:0">');
    }
}

if (!function_exists('message')) {
    function message($type, $route, $text)
    {
        return redirect($route)->with('message', ['type' => $type, 'text' => $text]);
    }
}

if (!function_exists('success')) {
    function success($route, $text = 'A művelet sikeresen végrehajtva')
    {
        return message('success', $route, $text);
    }
}

if (!function_exists('error')) {
    function error($route, $text = 'Hiba történt a művelet végrehajtása során')
    {
        return message('danger', $route, $text);
    }
}
