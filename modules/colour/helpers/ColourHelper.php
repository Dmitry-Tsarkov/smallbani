<?php


namespace app\modules\colour\helpers;


class ColourHelper
{
    public static function getHtml($title, $hex)
    {
        return '<div style="display: flex;">
            <span style="display: inline-block; width: 20px; height: 20px; margin-right: 5px; background: ' . $hex . '"></span>' . $title . '</div>';
    }
}
