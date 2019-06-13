<?php
namespace MedBrief\CoreBundle\Service;

use Symfony\Component\DependencyInjection\Container;

/**
 * Description of Encryption
 * @todo Maybe we should just get rid of this altogether? It
 *       doesn't look finished anyway plus it uses mcrypt
 *
 * @author rowan
 */
class EncryptionService {

	/**
	 * @var Container
	 */
    protected $container;
    
    protected $iv;
    
    public function __construct($container)
    {
        $this->container = $container;
        
    }
    
    public function simpleEncrypt($string, $secretKey = null)
    {
        if (is_null($secretKey)) {
            $secretKey = $this->getSecretKey();
        }
        
        return rawurlencode(bin2hex(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $secretKey, $string, MCRYPT_MODE_ECB)));
    }
    
    public function simpleDecrypt($encryptedString, $secretKey = null)
    {
        if (is_null($secretKey)) {
            $secretKey = $this->getSecretKey();
        }
        
        return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $secretKey, hex2bin(rawurldecode($encryptedString)), MCRYPT_MODE_ECB));
        
    }

	/**
	 * @throws \Exception
	 * @return string
	 */
    protected function getSecretKey()
    {
        $secretKey = $this->container->getParameter('secret');
        
        if (empty($secretKey)) {
            
            throw new \Exception("Attempting to use 'secret' parameter, but it is empty.  Are you sure your 'secret' parameter is set in your parameters.yml?");
        }

        return $secretKey;
    }
}
