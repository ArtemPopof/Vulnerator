<?php
/**
 * Created by PhpStorm.
 * User: popof
 * Date: 27.11.2017
 * Time: 1:44
 */

namespace Vulnerator;


class AbstractVulneratorTest implements VulneratorTestInterface
{
    /**
     * AbstractVulneratorTest constructor.
     * @param string $pageUrl
     */
    public function __construct()
    {
    }


    /**
     * Scores some element for vulnerability
     *
     * @param $pageUrl
     * @param $vulnerabilities array output list of vulnerabilities
     * @return int score
     */
    public function test($pageUrl, &$vulnerabilities)
    {
        // TODO: Implement test() method.
    }
}