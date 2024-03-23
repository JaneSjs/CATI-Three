<?php
namespace App\Reports;

/**
 * My Report
 */
class MyReport extends \koolreport\KoolReport
{
	use \koolreport\laravel\Friendship;
    // By adding above statement, you have claim the friendship between two frameworks
    // As a result, this report will be able to accessed all databases of Laravel
    // There are no need to define the settings() function anymore
    // while you can do so if you have other datasources rather than those
    // defined in Laravel.
	
    /**
     * Setup
     */
    public function setup()
    {
    	$database = env("DB_CONNECTION");

        $this->src($database)
             ->query("SELECT * FROM interviews")
             ->pipe($this->dataStore("respondents"));
    }
}
