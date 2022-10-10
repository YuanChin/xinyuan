<?php

use Illuminate\Database\Eloquent\Model;

if (!function_exists('checkRouteParam')) {
    /**
     * Check if the parameter of the current route is the correct value.
     *
     * @param $param
     * @param $value
     * @return bool
     */
    function checkRouteParam($param, $value)
    {
        $paramValue = request()->route($param);

        if (is_a($paramValue, Model::class)) {
            return $paramValue->{$paramValue->getKeyName()} == $value;
        }

        return false;
    }
}