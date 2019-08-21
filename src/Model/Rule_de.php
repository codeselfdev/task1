<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 20/8/19
 * Time: 10:53 PM
 */

namespace App\Model;

class Rule_de extends BaseRules{

    /**
     * @param Client $client
     * @return bool
     */
    public function __construct(\App\Model\Client  $client)
    {
        $this->client=$client;
    }
    public function verifyExpirity()
    {
        $initiate_date="2010-01-01";
        if($this->client->issue_date>=$initiate_date && $this->client->document_type=='identity_type') {
           parent::setExpireAfter(10);
        }
        return parent::verifyExpirity();
    }
}