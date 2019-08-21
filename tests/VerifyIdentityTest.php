<?php
namespace App\Tests;

use App\Model\Client;
use PHPUnit\Framework\TestCase;
class VerifyIdentityTest extends TestCase{
    public function testVerify(){
        $client_array=array();
        $s = serialize($client_array);
        // store $s somewhere where page2.php can find it.
        file_put_contents('store', $s);

        $client=new Client('2019-01-01','lt','passport','30122719','2019-03-01','357717289');
        $result=$client->verify();
        $this->assertEquals( 'valid',$result);

        $client_1=new Client('2019-01-01','pl','identity_card','9879386836','2018-11-01','643023760');
        $result=$client_1->verify();
        $this->assertEquals( 'valid',$result);

        $client_2= new Client('2019-01-02','lt','passport','46530663','2019-03-01','357717289');
        $result=$client_2->verify();
        $this->assertEquals( 'valid',$result);

        $client_3= new Client('2019-01-02','pl','identity_card','4531480055','2017-10-21','324444899');
        $this->assertEquals($client_3->verify(), 'document_number_length_invalid');

        $client_4= new Client('2019-01-03','lt','passport','54163812','2019-03-01','357717289');
        $this->assertEquals($client_4->verify(), 'request_limit_exceeded');

        $client_5= new Client('2019-01-03','fr','drivers_license','95180604','2018-07-02','942959784');
        $this->assertEquals($client_5->verify(), 'valid');

        $client_6= new Client('2019-01-03','de','identity_card','14253292','2009-01-01','962044284');
        $this->assertEquals($client_6->verify(), 'document_is_expired');

        $client_7= new Client('2019-01-03','fr','residence_permit','50016230','2019-04-01','141994836');
        $this->assertEquals($client_7->verify(), 'valid');

        $client_8= new Client('2019-01-04','uk','identity_card','64053869','2015-09-07','840252118');
        $this->assertEquals($client_8->verify(), 'document_type_is_invalid');

        $client_9= new Client('2019-01-04','es','passport','17728070','2013-03-01','772226409');
        $this->assertEquals($client_9->verify(), 'valid');

        $client_10= new Client('2019-01-04','pl','residence_permit','56934120','2016-08-01','643023760');
        $this->assertEquals($client_10->verify(), 'valid');

        $client_11= new Client('2019-01-04','es','passport','50008532','2015-09-08','320962200');
        $this->assertEquals($client_11->verify(), 'document_number_invalid');

        $client_11= new Client('2019-01-04','it','residence_permit','97316275','2019-01-05','621736871');
        $this->assertEquals($client_11->verify(), 'valid');

        $client_11= new Client('2019-02-15','it','passport','30810814','2019-02-16','415855641');
        $this->assertEquals($client_11->verify(), 'document_issue_date_invalid');

    }
}