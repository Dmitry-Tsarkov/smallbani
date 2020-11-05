<?php


namespace app\modules\admin\helpers;


class NestedSetsHelper
{
    public static function depthTitle($title, $depth)
    {
        return str_repeat('_ ', $depth - 1) . $title;
    }
}
