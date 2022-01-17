<?php
namespace EdmondsCommerce\MultiplicationTables\Test\Unit\Block\Product\View;
 
class MultiplicationTabTest extends \PHPUnit\Framework\TestCase
{
	/**
    * @var \Magento\Framework\TestFramework\Unit\Helper\ObjectManager
    */
    protected $_objectManager;
 
    /**
    * @var \EdmondsCommerce\MultiplicationTables\Block\Product\View\MultiplicationTab
    */
    protected $_multiplicationTab;
 
    /**
     * used to set the values to variables or objects.
     *
     * @return void
     */
    public function setUp() {
        $this->_objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);

        $this->registry = $this->getMockForAbstractClass(\Magento\Framework\Registry::class);
        $dataHelper = $this->getMockBuilder(\EdmondsCommerce\MultiplicationTables\Helper\Data::class)
            ->disableOriginalConstructor()
            ->getMock();
        $dataHelper->method('getConfigValue')
            ->willReturn(true);

        $this->_multiplicationTab = $this->_objectManager->getObject(
            \EdmondsCommerce\MultiplicationTables\Block\Product\View\MultiplicationTab::class,
            [
                'registry' => $this->registry,
                'dataHelper' => $dataHelper,
            ]
        );

        $this->_productModel = $this->_objectManager->getObject(\Magento\Catalog\Model\Product::class);
 
    }

    /**
     * Check multiplication table is allowed or not
     */
    public function testIsVisibleMultiplicationTable() {
    	/* Test Case 01 */
    	$productMock = $this->_productModel;
    	$productMock = $productMock->setXAxis(10)->setYAxis(5);
    	$this->_desiredResult = true;
    	$this->_actulResult = $this->_multiplicationTab->isVisibleMultiplicationTable($productMock);
        $this->assertEquals($this->_desiredResult, $this->_actulResult);

        /* Test Case 02 */
        $productMock = $this->_productModel;
    	$productMock = $productMock->setXAxis(0)->setYAxis(5);
    	$this->_desiredResult = false;
    	$this->_actulResult = $this->_multiplicationTab->isVisibleMultiplicationTable($productMock);
        $this->assertEquals($this->_desiredResult, $this->_actulResult);

        /* Test Case 03 */
        $productMock = $this->_productModel;
    	$productMock = $productMock->setXAxis(20)->setYAxis("TEST");
    	$this->_desiredResult = false;
    	$this->_actulResult = $this->_multiplicationTab->isVisibleMultiplicationTable($productMock);
        $this->assertEquals($this->_desiredResult, $this->_actulResult);

        /* Test Case 04 */
        $productMock = $this->_productModel;
    	$this->_desiredResult = false;
    	$this->_actulResult = $this->_multiplicationTab->isVisibleMultiplicationTable($productMock);
        $this->assertEquals($this->_desiredResult, $this->_actulResult);
    }
}