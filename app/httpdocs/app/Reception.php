<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Reception extends Model
{
  public $timestamps = false;
  protected $table = "receptions";
  protected $fillable = [ 'id_user','customer_id','pending','coupon','state','date_reception','longitude','latitude','name','last_name','address','departament','province','district','telephone','cellphone','address_email','orders_id','state_delivery','advanced_payments_id'];



  public function processPayment() {
    $client = new \GuzzleHttp\Client();

    $data["clientReferenceInformation"]["code"] = "TC50171_3";
    $data["processingInformation"]["commerceIndicator"] = "internet";
    $data["aggregatorInformation"]["subMerchant"]["cardAcceptorID"] = "1234567890";
    $data["aggregatorInformation"]["subMerchant"]["country"] = "US";
    $data["aggregatorInformation"]["subMerchant"]["phoneNumber"] = "650-432-0000";
    $data["aggregatorInformation"]["subMerchant"]["address1"] = "900 Metro Center";
    $data["aggregatorInformation"]["subMerchant"]["postalCode"] = "94404-2775";
    $data["aggregatorInformation"]["subMerchant"]["locality"] = "Foster City";
    $data["aggregatorInformation"]["subMerchant"]["name"] = "Visa Inc";
    $data["aggregatorInformation"]["subMerchant"]["administrativeArea"] = "CA";

    $data["aggregatorInformation"]["subMerchant"]["region"] = "PEN";
    $data["aggregatorInformation"]["subMerchant"]["email"] = "test@cybs.com";
    $data["aggregatorInformation"]["subMerchant"]["email"] = "test@cybs.com";
    $data["aggregatorInformation"]["name"] = "V-Internatio";
    $data["aggregatorInformation"]["aggregatorID"] = "V-Internatio";

    $data["orderInformation"]["billTo"]["country"] = "US";
    $data["orderInformation"]["billTo"]["lastName"] = "VDP";
    $data["orderInformation"]["billTo"]["address2"] = "Address 2";
    $data["orderInformation"]["billTo"]["address1"] = "201 S. Division St.";
    $data["orderInformation"]["billTo"]["postalCode"] = "48104-2201";
    $data["orderInformation"]["billTo"]["locality"] = "Ann Arbor";
    $data["orderInformation"]["billTo"]["administrativeArea"] = "MI";
    $data["orderInformation"]["billTo"]["firstName"] = "RTS";
    $data["orderInformation"]["billTo"]["phoneNumber"] = "999999999";
    $data["orderInformation"]["billTo"]["district"] = "MI";
    $data["orderInformation"]["billTo"]["buildingNumber"] = "123";
    $data["orderInformation"]["billTo"]["company"] = "Visa";
    $data["orderInformation"]["billTo"]["email"] = "test@cybs.com";

    $data["orderInformation"]["amountDetails"]["totalAmount"] = "102.21";
    $data["orderInformation"]["amountDetails"]["currency"] = "USD";

    $data["paymentInformation"]["card"]["expirationYear"] = "2031";
    $data["paymentInformation"]["card"]["number"] = "5555555555554444";
    $data["paymentInformation"]["card"]["securityCode"] = "123";
    $data["paymentInformation"]["card"]["expirationMonth"] = "12";
    $data["paymentInformation"]["card"]["type"] = "002";

    $response = $client->request('POST', 'https://sandbox.api.visa.com/cybersource/v2/payments?apikey=SFN7UE6C26SUYJPD77XC2141Qc2C-1L_f2zoxgB6tYW9E2NxU', $data);

    $curl = curl_init();
    // set timeout, if needed
    if ($this->config->getCurlTimeout() !== 0) {
        curl_setopt($curl, CURLOPT_TIMEOUT, $this->config->getCurlTimeout());
    }
    // set connect timeout, if needed
    if ($this->config->getCurlConnectTimeout() != 0) {
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $this->config->getCurlConnectTimeout());
    }

    // return the result on success, rather than just true
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, $data);


  }
  public function processAnAuthorizationReversal() {

  }
  public function CapturePayment() {

  }
  public function RefundPayment() {

  }
  public function refundCapture() {

  }
  public function processCredit() {

  }

}
