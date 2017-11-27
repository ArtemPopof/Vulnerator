<?php
/**
 * Created by PhpStorm.
 * User: popof
 * Date: 27.11.2017
 * Time: 1:33
 */

namespace Vulnerator;


class RobotsTxtTest extends AbstractVulneratorTest
{
    /**
     * RobotsTxtTest constructor.
     * @param string $pageUrl site url
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Scores robots.txt file for vulnerabilities
     *
     * @param $pageUrl
     * @param $vulnerabilities array output list of vulnerabilities
     * @return int score
     */
    public function test($pageUrl, &$vulnerabilities)
    {
        $robotsFile = file_get_contents("{$pageUrl}/robots.txt");

        if ( !$robotsFile ) {
            return 0;
        }

        $interestingFormats = [
            "txt" => 2,
            "sql" => 5,
            "php" => 8,
            "ini" => 10
        ];

        $finalScore = 0;

        /* Final length value */
        $finalScore += (int) (strlen($robotsFile) / 20);

        if ( strlen($robotsFile) > 120 ) {
            $vulnerabilities[] = "Big robots.txt file! ({$finalScore})";
        }

        foreach( $interestingFormats as $format => $score ) {
            if ( preg_match("/.{$format}$/", $robotsFile) ) {
                $finalScore += $score;
                $vulnerabilities[] = "Robots.txt contains files with {$format} extension ({$score})";
            }
        }

        if ( preg_match("/config/", $robotsFile) ) {
            $finalScore += 15;
            $vulnerabilities[] = "Robots.txt contains config path (15)";
        }

        return $finalScore;
    }
}