<?php

use OzdemirBurak\JsonCsv\File\Json;

/**
 * JSON To CSV Adapter
 */
class JsonToCSV extends Json
{
    /**
     * summary
     */
    public function __construct($json)
    {
        $this->data = $json;
    }

    public function convert() : string
    {
    	
    }
}