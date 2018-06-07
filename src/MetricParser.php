<?php
/**
 * Created by PhpStorm.
 * User: edwin
 * Date: 04-06-18
 * Time: 16:04
 */

namespace edwrodrig\cnv_parser;


class MetricParser
{
    /**
     * @var int
     */
    private $index;

    /**
     * @var MetricInfoParser
     */
    private $info_parser;

    /**
     * Header key validation regular expression
     */
    const KEY_REGEXP = '/^name (\d+)/';


    public function __construct(HeaderLineParser $header)
    {
        if (preg_match(self::KEY_REGEXP, $header->getKey(), $matches)) {
            $this->index = intval($matches[1]);
        }

        $this->info_parser = new MetricInfoParser($header->getValue());
    }

    /**
     * Get the column index
     *
     * Is the position of the column starting from 0
     * @return int
     */
    public function getIndex() : int {
        return $this->index;
    }

    /**
     * Get the information of the column.
     *
     * @return MetricInfoParser
     */
    public function getInfo() : MetricInfoParser {
        return $this->info_parser;
    }

    /**
     * Check if a header line is a metric
     *
     * A metric is description data of a column in the data section
     * @param HeaderLineParser $header
     * @return bool
     */
    public static function isMetric(HeaderLineParser $header) : bool {
        if ( !$header->isIndexed() ) return false;

        if ( preg_match(self::KEY_REGEXP, $header->getKey()) )
            return true;
        else return false;
    }



}