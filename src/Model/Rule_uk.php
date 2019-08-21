<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 20/8/19
 * Time: 10:53 PM
 */

namespace App\Model;

class Rule_uk extends BaseRules{

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
    public function verify_document_type()
    {
        $initiate_date="2019-01-01";
        if($this->client->request_date >= $initiate_date) {
           parent::setDocumentType(["Passport"]);
        }
            return parent::verify_document_type();
    }
}