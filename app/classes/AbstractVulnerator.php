<?php
/**
 * Created by PhpStorm.
 * User: popof
 * Date: 27.11.2017
 * Time: 1:37
 */

namespace Vulnerator;


use HttpUrlException;

class AbstractVulnerator implements VulneratorInterface
{
    /* @var $tests VulneratorTestInterface */
    protected $tests;

    /* @var array The list of vulnerabilities */
    protected $vulnerabilities;

    protected $score;

    /**
     * AbstractVulnerator constructor.
     */
    public function __construct()
    {
        $this->initialize();
    }

    protected function initialize() {
        $this->tests = [];
        $this->vulnerabilities = [];
        $this->score = 0;
    }

    public function reset() {
        $this->vulnerabilities = [];
        $this->score = 0;
    }

    /**
     * @param string $page web page address
     * @return integer web page rank
     *
     * @throws HttpUrlException If no page available
     */
    public function getPageRank(string $page)
    {
        return $this->score;
    }

    /**
     * @param VulneratorTestInterface $test
     */
    public function addVulneratorTest(VulneratorTestInterface $test) {
        $this->tests[] = $test;
    }


    /**
     * @param string $pageUrl
     */
    protected function scoreAll(string $pageUrl) {
        /* @var $test VulneratorTestInterface */
        foreach ( $this->tests as $test ) {
            $this->score += (int) $test->test($pageUrl, $this->vulnerabilities);
        }
    }

    /**
     * @return array
     */
    public function getVulnerabilities(): array
    {
        return $this->vulnerabilities;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }
}