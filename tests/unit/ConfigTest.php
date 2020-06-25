<?php

namespace Securetrading\Config\Tests\Unit;

class ConfigTest extends \Securetrading\Unittest\UnittestAbstract {
  protected $_config;

  public function setUp() : void {
    $data = $this->_getConfigData();
    $this->_config = new \Securetrading\Config\Config($data);
  }

  private function _getConfigData() {
    return array(
      'a' => 'a_value',
      'b' => array(
        'a' => 'a_value',
	'b' => array(
          'a' => 'a_value'
	),
      ),
    );
  }

  /**
   * @dataProvider providerHas
   */
  public function testHas($keyToSearchFor, $expectedReturnValue) {
    $actualReturnValue = $this->_config->has($keyToSearchFor);
    $this->assertEquals($expectedReturnValue, $actualReturnValue);
  }

  public function providerHas() {
    $this->_addDataSet('a', true);
    $this->_addDataSet('b', true);
    $this->_addDataSet('b/a', true);
    $this->_addDataSet('b/b', true);
    $this->_addDataSet('b/b/a', true);

    $this->_addDataSet('c', false);
    $this->_addDataSet('b/c', false);
    $this->_addDataSet('b/b/b', false);

    return $this->_getDataSets();
  }

  /**
   * @dataProvider providerGet_KeysThatExist
   */
  public function testGet_KeysThatExist($keyToGet, $expectedReturnValue) {
    $actualReturnValue = $this->_config->get($keyToGet);
    $this->assertEquals($expectedReturnValue, $actualReturnValue);
  }

  public function providerGet_KeysThatExist() {
    $this->_addDataSet('a', 'a_value');
    $this->_addDataSet('b/a', 'a_value');
    $this->_addDataSet('b/b', array('a' => 'a_value'));
    $this->_addDataSet('b/b/a', 'a_value');
    $this->_addDataSet('b', array(
      'a' => 'a_value',
      'b' => array(
        'a' => 'a_value'
      ),
    ));
    
    return $this->_getDataSets();
  }

  /**
   * @dataProvider providerGet_KeysThatDoNotExist()
   */
  public function testGet_KeysThatDoNotExist($keyToGet) {
    $this->expectException(\Securetrading\Config\ConfigException::class);
    $this->expectExceptionCode(\Securetrading\Config\ConfigException::CODE_KEY_DOES_NOT_EXIST);
      
    $this->_config->get($keyToGet);
  }

  public function providerGet_KeysThatDoNotExist() {
    $this->_addDataSet('c');
    $this->_addDataSet('b/c');
    $this->_addDataSet('b/b/b');
    return $this->_getDataSets();
  }

  /**
   * 
   */
  public function testSet_ReturnValue() {
    $expectedReturnValue = get_class($this->_config);
    $returnValue = $this->_config->set('a', 'b');
    $this->assertSame($this->_config, $returnValue);
  }

  /**
   * @dataProvider providerSet_SetsDataCorrectly
   */
  public function testSet_SetsDataCorrectly($keyToSet, $valueToSet) {
    $this->_config->set($keyToSet, $valueToSet);
    $valueThatWasSet = $this->_config->get($keyToSet);
    $this->assertEquals($valueToSet, $valueThatWasSet);
  }

  public function providerSet_SetsDataCorrectly() {
    $this->_addDataSet('k1', 'value1');
    $this->_addDataSet('k2/k2a', 'value2');
    $this->_addDataSet('k2/k2a/k2b', 'value3');
    return $this->_getDataSets();
  }
  
  /**
   * 
   */
  public function testToArray() {
    $expectedReturnValue = $this->_getConfigData();
    $actualReturnValue = $this->_config->toArray();
    $this->assertEquals($expectedReturnValue, $actualReturnValue);
  }
}