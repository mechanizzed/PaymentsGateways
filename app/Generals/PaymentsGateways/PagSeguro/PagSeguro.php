<?php


namespace PagSeguro\Generals\PaymentsGateways\PagSeguro;

use PagSeguroPaymentRequest;
use PagSeguroLibrary;
use PagSeguroAccountCredentials;

class PagSeguro
{
  private $config;
  private $name;
  private $surname;
  private $email;
  private $area;
  private $phone;
  private $referenceId;
  private $credentials;
  private $addItems = [];
  private $customerValues;
  
  public function __construct(PagSeguroPaymentRequest $pagSeguroRequest)
  {
    $this->config = $pagSeguroRequest;
    PagSeguroLibrary::init();
  }
  
  private function orderValues()
  {
    $this->config->setSender(
      $this->name . ' ' . $this->surname,
      $this->email,
      $this->area,
      $this->phone
    );
    
    $this->config->setCurrency("BRL");
    $this->config->setReference($this->referenceId);
    $this->config->setShippingAddress(null);
    $this->config->addItem($this->addItems['id'], $this->addItems['product'], $this->addItems['qtd'], $this->addItems['price']);
  }
  
  public function sendPayment()
  {
    $this->orderValues();
    $this->credentials = new PagSeguroAccountCredentials('email', 'token');
    $url = $this->config->register($this->credentials);
    return $url;
  }
  
}