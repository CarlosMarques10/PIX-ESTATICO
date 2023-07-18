<?php

namespace App\pix;

class Tool  extends Info{
    
      /**
   * IDs do Payload do Pix
   * @var string
   */
  const ID_PAYLOAD_FORMAT_INDICATOR = '00';
  const ID_MERCHANT_ACCOUNT_INFORMATION = '26';
  const ID_MERCHANT_ACCOUNT_INFORMATION_GUI = '00';
  const ID_MERCHANT_ACCOUNT_INFORMATION_KEY = '01';
  const ID_MERCHANT_ACCOUNT_INFORMATION_DESCRIPTION = '02';
  const ID_MERCHANT_CATEGORY_CODE = '52';
  const ID_TRANSACTION_CURRENCY = '53';
  const ID_TRANSACTION_AMOUNT = '54';
  const ID_COUNTRY_CODE = '58';
  const ID_MERCHANT_NAME = '59';
  const ID_MERCHANT_CITY = '60';
  const ID_ADDITIONAL_DATA_FIELD_TEMPLATE = '62';
  const ID_ADDITIONAL_DATA_FIELD_TEMPLATE_TXID = '05';
  const ID_CRC16 = '63';


  

  private function getValue($id,$value){
    $size = str_pad(strlen($value),2,'0',STR_PAD_LEFT);
    return $id.$size.$value;
  }

  private function getMerchantAccountInformation(){
    $gui = $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_GUI, 'br.gov.bcb.pix');

    $key = $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_KEY, $this->getChavePix());

    $description = $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_DESCRIPTION, $this->getDescricao());

    return $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION, $gui.$key.$description);

  }

  private function getAdditionalDataFieldTemplate(){
    $txId = $this->getValue(self::ID_ADDITIONAL_DATA_FIELD_TEMPLATE_TXID, $this->getIdTransacao());
    return $this->getValue(self::ID_ADDITIONAL_DATA_FIELD_TEMPLATE,$txId);
  }


  public function getTool(){
    $tool = $this->getValue(self::ID_PAYLOAD_FORMAT_INDICATOR,'01').
                              $this->getMerchantAccountInformation().
                              $this->getValue(self::ID_MERCHANT_CATEGORY_CODE, '0000').
                              $this->getValue(self::ID_TRANSACTION_CURRENCY,'986').
                              $this->getValue(self::ID_TRANSACTION_AMOUNT,$this->getValor()).
                              $this->getValue(self::ID_COUNTRY_CODE, 'BR').
                              $this->getValue(self::ID_MERCHANT_NAME,$this->getNomeTitular()).
                              $this->getValue(self::ID_MERCHANT_CITY, $this->getCidadeTitular()).
                              $this->getAdditionalDataFieldTemplate();

                              
    return $tool.$this->getCRC16($tool);
  }


    /**
   * Método responsável por calcular o valor da hash de validação do código pix
   * @return string
   */
  private function getCRC16($tool) {
    //ADICIONA DADOS GERAIS NO PAYLOAD
    $tool .= self::ID_CRC16.'04';

    //DADOS DEFINIDOS PELO BACEN
    $polinomio = 0x1021;
    $resultado = 0xFFFF;

    //CHECKSUM
    if (($length = strlen($tool)) > 0) {
        for ($offset = 0; $offset < $length; $offset++) {
            $resultado ^= (ord($tool[$offset]) << 8);
            for ($bitwise = 0; $bitwise < 8; $bitwise++) {
                if (($resultado <<= 1) & 0x10000) $resultado ^= $polinomio;
                $resultado &= 0xFFFF;
            }
        }
    }

    //RETORNA CÓDIGO CRC16 DE 4 CARACTERES
    return self::ID_CRC16.'04'.strtoupper(dechex($resultado));

}

public function numeroIdTransacao(){
    $length = rand(10, 25);  // Gera um comprimento aleatório entre 10 e 25
    $randomString = '';

  for ($i = 0; $i < $length; $i++) {
      $randomNumber = rand(0, 9);  // Gera um número aleatório entre 0 e 9
      $randomString .= $randomNumber;
  }
  return "E".$randomString;
}






}