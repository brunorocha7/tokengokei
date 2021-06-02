<?php

if ($URI != '/seguranca/connect/token'){
       
       $request = OAuth2\Request::createFromGlobals();
       $response = new OAuth2\Response();
       $scopeRequired = 'cobranca';
       
       $username = 'gokeiuser';
       $password = 'gokeitech@873638';
       
       $pdo = new PDO('mysql:host=localhost;dbname=gokeipst_token', $username, $password);
     
       $pdoStorage = new OAuth2\Storage\Pdo($pdo);
               
       $keyStorage = new OAuth2\Storage\Memory(array('keys' => array(
           'public_key'  => file_get_contents('gokeipstipub.pem'),
           'private_key' => file_get_contents('gokeipsti.pem'),
       )));
               
       $server = new OAuth2\Server($pdoStorage);
      
       if (!$server->verifyResourceRequest($request,$response,$scopeRequired)) {
        
         $response->send();
         exit;
         
       }
                  
   }else{
   
       $username = 'gokeiuser';
       $password = 'gokeitech@873638';
       
       $pdo = new PDO('mysql:host=localhost;dbname=gokeipst_token', $username, $password);
     
       $pdoStorage = new OAuth2\Storage\Pdo($pdo);
       
       
       $keyStorage = new OAuth2\Storage\Memory(array('keys' => array(
           'public_key'  => file_get_contents('gokeipstipub.pem'),
           'private_key' => file_get_contents('gokeipsti.pem'),
       )));
       
              
       $server = new OAuth2\Server($pdoStorage);
       
            
       $server->addGrantType(new OAuth2\GrantType\ClientCredentials($pdoStorage));
       
       $server->addGrantType(new OAuth2\GrantType\AuthorizationCode($pdoStorage));
       
       $server->handleTokenRequest(OAuth2\Request::createFromGlobals())->send();
       exit;
       //"http://contause.digital/s/oauth/seguranca/connect/token"
       //"client_id=usuario_prod&client_secret=s3e_ddf64gLKwt70948&grant_type=client_credentials&scope=geral"
   
   
   }