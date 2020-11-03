<?php

namespace app\modules\admin\helpers;

class YoutubeHelper
{
    public static function id($url)
    {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        $youtube_id = !empty($match[1]) ? $match[1] : trim($url);
        if (preg_match('/^[a-z0-9-_]+$/i', $youtube_id)) {
            return $youtube_id;
        }

        return null;
    }

    public static function url($url): string
    {
        $id = self::id($url);
        if (empty($id)) {
            return '';
        }

        return 'https://www.youtube.com/watch?v=' . $id;
    }

    public static function previewImage($url)
    {
        $id = self::id($url);
        if (empty($id)) {
            return '';
        }

        return 'http://img.youtube.com/vi/' . $id . '/maxresdefault.jpg';
    }
}

