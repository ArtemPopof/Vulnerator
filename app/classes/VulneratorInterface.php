<?php
/**
 * Created by PhpStorm.
 * User: popof
 * Date: 27.11.2017
 * Time: 0:33
 */

namespace Vulnerator;

use HttpUrlException;

interface VulneratorInterface
{
    /**
     * @param string $page web page address
     * @return integer web page rank
     *
     * @throws HttpUrlException If no page available
     */
    public function getPageRank(string $page);
}