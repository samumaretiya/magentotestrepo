<?php
namespace EdmondsCommerce\MultiplicationTables\Test\Unit\Helper;
 
class DataTest extends \PHPUnit\Framework\TestCase
{
	/**
    * @var \Magento\Framework\TestFramework\Unit\Helper\ObjectManager
    */
    protected $_objectManager;
 
    /**
    * @var \EdmondsCommerce\MultiplicationTables\Block\Product\View\MultiplicationTab
    */
    protected $_dataHelper;
 
    /**
     * used to set the values to variables or objects.
     *
     * @return void
     */
    public function setUp() {
        $this->_objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);

        $this->_dataHelper = $this->_objectManager->getObject(\EdmondsCommerce\MultiplicationTables\Helper\Data::class);
    }

    /**
     * Check given number is valid Integer or not
     */
    public function testIsValidInteger() {
    	/* Test Case 01 */
    	$this->_desiredResult = true;
    	$this->_actulResult = $this->_dataHelper->isValidInteger(10);
        $this->assertEquals($this->_desiredResult, $this->_actulResult);

        /* Test Case 02 */
    	$this->_desiredResult = false;
    	$this->_actulResult = $this->_dataHelper->isValidInteger(0);
        $this->assertEquals($this->_desiredResult, $this->_actulResult);
        
        /* Test Case 03 */
    	$this->_desiredResult = true;
    	$this->_actulResult = $this->_dataHelper->isValidInteger("100");
        $this->assertEquals($this->_desiredResult, $this->_actulResult);

        /* Test Case 04 */
    	$this->_desiredResult = false;
    	$this->_actulResult = $this->_dataHelper->isValidInteger(-10);
        $this->assertEquals($this->_desiredResult, $this->_actulResult);
    }
}