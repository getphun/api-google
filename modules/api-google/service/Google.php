<?php
/**
 * google service
 * @package api-google
 * @version 0.0.1
 * @upgrade true
 */

namespace ApiGoogle\Service;

class Google {
    
    protected $client = [];
    
    public function __construct(){
        require_once dirname(__DIR__) . '/third-party/Google/vendor/autoload.php';
    }
    
    public function addScope($name, $scopes){
        $this->client[$name]->addScope($scopes);
    }
    
    public function buildToken($name){
        $cache_name = 'google-token-' . md5($name);
        $dis = \Phun::$dispatcher;
        
        $token = $dis->cache->get($cache_name);
        if($token){
            $this->client[$name]->setAccessToken($token);
            if(!$this->client[$name]->isAccessTokenExpired())
                return;
        }
        
        $token = $this->client[$name]->fetchAccessTokenWithAssertion();
        if(!$token)
            return;
        
        $dis->cache->save($cache_name, $token, $token['expires_in']);
    }
    
    public function createAccount($name, $scopes=null, $sa_file=null){
        $account_file = BASEPATH . '/etc/';
        $account_file.= $sa_file ?? 'api-google.json';
    
        if(!is_file($account_file))
            throw new \Exception('Google service account json file not found');
        
        $this->client[$name] = new \Google_Client();
        $this->client[$name]->setAuthConfig($account_file);
        
        if($scopes)
            $this->addScope($name, $scopes);
        
        $this->buildToken($name);
        
        return $this->client[$name];
    }
    
    public function forRAnalytics($sa_file=null){
        if(isset($this->client['r-ga']))
            return $this->client['r-ga'];
        return $this->createAccount('r-ga',\Google_Service_Analytics::ANALYTICS_READONLY,$sa_file);
    }
}