<?php

//This class gets latest exchange rate in the real world from https://exchangeratesapi.io API
class CurrencyWebService{

  //code of the currency (i.e. USD, BRL, COP, GBP, INR ...)
  static public $currency;

  //get rate
  static public function getExchangeRate() : float {
    try{
      //calls the webService 
      $foreingCurrency_json = file_get_contents(CURRENCY_API_URL.self::$currency);
      
      if (!$foreingCurrency_json){
        throw new Exception('Error trying Web Service for currency('.self::$currency.').');
      }

      //recieves the result and decode it generating an array
      $foreingCurrency_array = json_decode($foreingCurrency_json, true);

      //return result rate
      return $foreingCurrency_array['rates'][self::$currency];
      
    } catch (Exception $ex) {
        $date = new DateTime();
        error_log(PHP_EOL.$date->format("Ymd H:i:s").': '.$ex->getMessage(), 3, LOG_FILE);
        return false;
    }
  }

}

?>