<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 20/8/19
 * Time: 10:53 PM
 */

namespace App\Model;

class Rule_lt extends BaseRules{

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
        if($this->client->document_type=='drivers_license') {
            return true;
        }else{
           return parent::verify_document_type();
        }
    }
    /**
     * @return bool
     */
    public function verifyExpirity()
    {
        if($this->client->document_type=='drivers_license') {
            return true;
        }else{
           return parent::verifyExpirity();
        }

    }
}