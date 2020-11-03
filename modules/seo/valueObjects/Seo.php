<?php


namespace app\modules\seo\valueObjects;


class Seo
{
    private $title;
    private $description;
    private $keywords;
    private $h1;

    public function __construct($title, $description, $keywords, $h1)
    {
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
        $this->h1 = $h1;
    }

    public static function blank(): self
    {
        return new self(null, null, null, null);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getKeywords()
    {
        return $this->keywords;
    }

    public function getH1()
    {
        return $this->h1;
    }
}
