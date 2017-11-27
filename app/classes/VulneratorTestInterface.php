<?php
/**
 * Created by PhpStorm.
 * User: popof
 * Date: 27.11.2017
 * Time: 1:31
 */

namespace Vulnerator;

/**
 * Interface VulneratorTestInterface
 * @package Vulnerator
 */
interface VulneratorTestInterface
{
    /**
     * Scores some element for vulnerability
     *
     * @param $pageUrl
     * @param $vulnerabilities array output list of vulnerabilities
     * @return int score
     */
    public function test($pageUrl, &$vulnerabilities);
}