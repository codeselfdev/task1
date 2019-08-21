<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 20/8/19
 * Time: 10:53 PM
 */

namespace App\Model;

class Rule_pl extends BaseRules{

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
        $initiate_date="2015-06-01";
        if($this->client->issue_date >= $initiate_date && $this->client->document_type=='residence_permit') {
            return true;
        }else{
            return parent::verify_document_type();
        }
    }
    /**
     * @return bool
     */
    public function verify_document_length()
    {
        $initiate_date="2018-09-01";
        if($this->client->issue_date >= $initiate_date  && $this->client->document_type=='identity_card') {
           parent::setDocumentLength(10);
        }
           return parent::verify_document_length();


    }
}