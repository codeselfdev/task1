<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 20/8/19
 * Time: 10:53 PM
 */

namespace App\Model;

class Rule_es extends BaseRules{

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
    public function verifyExpirity()
    {
        $initiate_date="2013-02-14";
        if($this->client->issue_date>=$initiate_date && $this->client->document_type=='passport') {
            parent::setExpireAfter(15);

        }
        return parent::verifyExpirity();
    }
    /**
     * @return bool
     */
    public function verify_invalid_document_number()
    {
        $initiate_date="2013-02-14";
        if($this->client->issue_date>=$initiate_date && $this->client->document_type=='passport') {
            parent::setInvalidDocument(range(50001111, 50009999));
        }
        return parent::verify_invalid_document_number();
    }
}