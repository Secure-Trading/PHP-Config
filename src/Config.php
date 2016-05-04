<?php

namespace Securetrading\Config;

class Config implements ConfigInterface {
  protected $_config = array();
  
  public function __construct(array $config = array()) {
    $this->_config = $config;
  }
  
  public function has($key) {
    $return = true;
    $config = &$this->_config;
    $array = explode('/', $key);
    
    foreach($array as $keySegment) {
      if (!array_key_exists($keySegment, $config)) {
	$return = false;
	break;
      }
      $config = &$config[$keySegment];
    }
    return $return;
  }
  
  public function get($key) {
    $config = &$this->_config;
    $array = explode('/', $key);
    foreach($array as $keySegment) {
      if (is_array($config) && array_key_exists($keySegment, $config)) {
	$config = &$config[$keySegment];
	continue;
      }
      throw new ConfigException(sprintf('Could not retrieve the key "%s".', $key), ConfigException::CODE_KEY_DOES_NOT_EXIST);
    }
    return $config;
  }
  
  public function set($key, $value) {
    $config = &$this->_config;
    $array = explode('/', $key);
    $lastIndex = array_pop($array);
    
    foreach($array as $keySegment) {
      if (!array_key_exists($keySegment, $config)) {
	$config[$keySegment] = array();
      }
      $config = &$config[$keySegment];
    }
    
    $config[$lastIndex] = $value;
    return $this;
  }
  
  public function toArray() {
    return $this->_config;
  }
}