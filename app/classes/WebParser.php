<?php
/**
 * Created by PhpStorm.
 * User: popof
 * Date: 27.11.2017
 * Time: 20:14
 */

namespace Vulnerator;

/**
 * Class WebParser
 * Recursively parse web site links
 *
 * @package Vulnerator
 */
class WebParser
{
    protected $currentUrl;
    private $urls;
    private $parsedUrls;

    /**
     * @return mixed
     */
    public function getUrls()
    {
        return $this->urls;
    }

    /**
     * WebParser constructor.
     * @param $startUrl string The url to start parsing
     */
    public function __construct($startUrl)
    {
        $this->currentUrl = $startUrl;
        $this->urls[] = $this->currentUrl;
        $this->parsedUrls = [];
    }

    /**
     * @param int $level recursive deep
     */
    public function parse($level = 1) {
        if ( $level <= 0 ) {
            return;
        }

        $html = file_get_contents($this->currentUrl);

        if ( !$html ) {
            return;
        }

        error_log("html: $html");

        $matches = [];

        preg_match_all("/(http|https):\/\/[-a-zA-Z0-9@:%_\+.~\#?&\/\/=]{2,256}\.(ru|com|net|org)/si", $html, $matches);

        $filtered = [];
        foreach ( $matches[0] as $match ) {
            if ( !isset($this->parsedUrls[$match]) && $match != $this->currentUrl ) {
                $filtered[] = $match;
                $this->parsedUrls[$match] = 1;
            }
        }

        $this->urls = array_merge($this->urls, $filtered);

        foreach ( $this->urls as $match ) {
            $this->currentUrl = $match;
            $this->parse($level - 1);
        }
    }
}