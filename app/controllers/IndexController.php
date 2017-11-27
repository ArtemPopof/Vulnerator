<?php
use Phalcon\Mvc\Controller;

use Vulnerator\SimpleVulnerator;
use Vulnerator\WebParser;

/**
 * Created by PhpStorm.
 * User: popof
 * Date: 18.11.2017
 * Time: 1:08
 */
class IndexController extends Controller
{
    public function indexAction() {

    }

    public function attackAction() {
        $vulnerator = new SimpleVulnerator();

        $url = $this->request->getPost("url", "url");
        $level = $this->request->getPost("level", "int", 1);

        if ( !$url ) {
            return "<p color='red'>Missing required property 'url'!</p>";
        }

        if ( $level > 0 ) {
            $webParser = new WebParser($url);
            $webParser->parse($level);

            $urls = $webParser->getUrls();
        } else {
            $urls = [$url];
        }

        $vulnerabilities = [];
        foreach ( $urls as $site ) {
            $score = 0;
            try {
                $score = $vulnerator->getPageRank($site);
            } catch (\Exception $e) {
                $score = $e->getMessage();
            }

            $vulnerabilities[$site]["list"] = $vulnerator->getVulnerabilities();
            $vulnerabilities[$site]["score"] = $score;

            $vulnerator->reset();
        }

        $this->view->vulnerabilities = $vulnerabilities;
        $this->view->url = $url;
    }
}