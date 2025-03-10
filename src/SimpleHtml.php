<?php

namespace Src\ParsingService;

require_once 'simple_html_dom.php';

class SimpleHtml
{
    public static function getNode(string $url)
    {
        return file_get_html($url);
    }
}
