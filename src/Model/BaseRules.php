<?php
namespace App\Model;

class BaseRules{
    protected $document_types=['passport','identity_card','residence_permit'];
    protected $document_no_length=8;
    protected $expire_after=5;
    protected $working_days=["Monday","Tuesday","Wednesday","Thursday","Friday"];
    protected $limit=2;
    protected $validity=true;
    protected $invalid_documents=[];
    protected $client;
    public function __construct(\App\Model\Client  $client)
    {
        $this->client=$client;
    }

    /**
     * @param int $expire_after
     */
    public function setExpireAfter(int $expire_after): void
    {
        $this->expire_after = $expire_after;
    }
    /**
     * @param array $workdays
     */
    public function setWorkDays(array $workdays): void
    {
        $this->working_days = $workdays;
    }
    /**
     * @param array $types
     */
    public function setDocumentType(array $types): void
    {
        $this->document_types = $types;
    }
    /**
     * @param array $invalid_documents
     */
    public function setInvalidDocument(array $invalid_documents){
        $this->invalid_documents = $invalid_documents;
    }
    /**
     * @param int $documentLength
     */
    public function setDocumentLength(int $documentLength){
        $this->document_no_length = $documentLength;
    }
    /**
     * @return bool
     */

    public function verifyExpirity()
    {
        if(date('Y-m-d', strtotime('+'.$this->expire_after.' years', strtotime($this->client->issue_date)))<$this->client->request_date){
            return  false;
        }else{
            return true;
        }
    }
    /**
     * @return bool
     */
    public function verify_document_type(){
        if(!in_array($this->client->document_type, $this->document_types)){
            return false;
        }else{
            return true;
        }
    }

    /**
     * @return bool
     */
    public function verify_document_length()
    {
        if(strlen($this->client->document_number)!=$this->document_no_length){
            return false;
        }else{
            return true;
        }
    }

    /**
     * @return bool
     */
    public function verify_invalid_issue_date()
    {
        if(!in_array(date('l',strtotime($this->client->issue_date)),$this->working_days)){
            return false;
        }else{
            return true;
        }
    }

    /**
     * @return bool
     */
    public function verify_invalid_document_number()
    {
        if(in_array($this->client->document_number,$this->invalid_documents)){
            return false;
        }else{
            return true;
        }

    }

    /**
     * @return bool
     */
    public function verify_application_request()
    {
        $s = file_get_contents('store');
        $a = unserialize($s);

        $date_limit_start_from=date('Y-m-d',strtotime('previous '.$this->working_days[0].$this->client->request_date));
        $date_limit_end_from=date('Y-m-d',strtotime('next '.$this->working_days[count($this->working_days)-1].$this->client->request_date));
        $limit=0;
        foreach ($a as $cl){
            if($cl->identity_number == $this->client->identity_number){
                if($date_limit_start_from <= $cl->request_date && $date_limit_end_from >= $cl->request_date){
                    $limit=$limit+1;
                }
            }
        }

        if($limit > 2){
            return false;
        }else{
            return true;
        }

    }
}