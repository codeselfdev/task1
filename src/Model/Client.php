<?php

namespace App\Model;

define("ERROR_TYPE", "document_type_is_invalid");
define("ERROR_EXPIRED", "document_is_expired");
define("ERROR_INVALID", "document_number_length_invalid");
define("ERROR_DOCUMENT", "document_number_invalid");
define("ERROR_ISSUE_DATE", "document_issue_date_invalid");
define("ERROR_LIMIT_EXIST", "request_limit_exceeded");
Class Client{
    public $request_date;
    public $country_code;
    public $document_type;
    public $document_number;
    public $issue_date;
    public $identity_number;
    public $no_of_application=0;
    public function __construct($request_date,$country_code,$document_type,$document_number,$issue_date,$identity_number)
    {
        $this->request_date = $request_date;
        $this->country_code = $country_code;
        $this->document_type = $document_type;
        $this->document_number = $document_number;
        $this->issue_date = $issue_date;
        $this->identity_number = $identity_number;

        $s = file_get_contents('store');
        $client_array = unserialize($s);
        array_push($client_array,$this);
        $s = serialize($client_array);
        file_put_contents('store', $s);
    }

    public function verify(){
        $class_name='\App\Model\Rule_'.$this->country_code;
        if(class_exists(''.$class_name)){
            $class=new $class_name($this);
            if (!$class->verify_application_request()){
                return ERROR_LIMIT_EXIST;
            }elseif (!$class->verify_document_length()){
                return ERROR_INVALID;
            }elseif(!$class->verifyExpirity()){
                return ERROR_EXPIRED;
            }elseif (!$class->verify_document_type()){
                return ERROR_TYPE ;
            }elseif (!$class->verify_invalid_issue_date()){
                return ERROR_ISSUE_DATE;
            }elseif (!$class->verify_invalid_document_number()){
                return ERROR_DOCUMENT;
            }else{
                return 'valid';
            }
        }else{
           return'Note Supported';
        }
    }
}