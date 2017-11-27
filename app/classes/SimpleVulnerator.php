<?php
/**
 * Created by PhpStorm.
 * User: popof
 * Date: 27.11.2017
 * Time: 0:30
 */

namespace Vulnerator;

use HttpUrlException;

/**
 * Class SimpleVulnerator
 * The purpose of this class is to rank some web site
 * in terms of vulnerability perspectives
 *
 * @package Vulnerator
 * @version 0.1
 *
 */
class SimpleVulnerator extends AbstractVulnerator
{
    private $pageHtml;
    private $pageUrl;
    private $logger;

    /**
     * SimpleVulnerator constructor.
     */
    public function __construct()
    {
        parent::__construct();

        /* Add tests */
        $this->addVulneratorTest(new RobotsTxtTest());

        $this->logger = new Logger("SimpleVulnerator");
    }


    /**
     * Returns a score for web page. Much score -
     * more vulnerabilities has this site
     *
     * @param string $page web page address
     * @return int web page rank
     * @throws HttpUrlException
     */
    public function getPageRank(string $page)
    {
        $this->pageUrl = $page;
        $this->pageHtml = file_get_contents($page);

        if ( !$this->pageHtml ) {
            throw new \Exception("Failed to get {$page} page");
        }

        // Test for open robots
        $this->scoreAll($this->pageUrl);

        return $this->score;
    }
}