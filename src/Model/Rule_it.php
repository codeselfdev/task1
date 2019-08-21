<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 20/8/19
 * Time: 10:53 PM
 */

namespace App\Model;

class Rule_it extends BaseRules{

    /**
     * @param Client $client
     */
    public function __construct(\App\Model\Client  $client)
    {
        $this->client=$client;
    }

    /**
     * @return bool
     */
    public function verify_invalid_issue_date()
    {
        $initiate_date="2019-01-01";
        $end_date="2019-01-31";
        if($this->client->issue_date >= $initiate_date  && $this->client->issue_date <= $end_date) {
           parent::setWorkDays(["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]);
        }
           return parent::verify_invalid_issue_date();


    }
}