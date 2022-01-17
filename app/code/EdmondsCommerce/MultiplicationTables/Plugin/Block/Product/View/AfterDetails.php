<?php
namespace EdmondsCommerce\MultiplicationTables\Plugin\Block\Product\View;

class AfterDetails
{
	/**
     * Data Helper
     *
     * @var \EdmondsCommerce\MultiplicationTables\Helper\Data
     */
    protected $_dataHelper;

    /**
     * Constructor Method
     *
     * @param \EdmondsCommerce\MultiplicationTables\Helper\Data $dataHelper
     */
    public function __construct(
        \EdmondsCommerce\MultiplicationTables\Helper\Data $dataHelper
    ) {
        $this->_dataHelper = $dataHelper;
    }

	/**
     * Change Tab Title
     *
     * @param string $alias
     * @param string $key
     * @return mixed
     */
    public function afterGetChildData(
    	\Magento\Catalog\Block\Product\View\Details $subject,
    	$result,
    	$alias, 
    	$key = ''
   	) {
   		if(!$this->_dataHelper->getConfigValue(\EdmondsCommerce\MultiplicationTables\Helper\Data::XML_PATH_MODULE_IS_ENABLED)) {
            return $result;
        }
        if($key && $key == "title" && $alias == "multiplication.table") {
        	$tabTitle = $this->_dataHelper->getConfigValue(\EdmondsCommerce\MultiplicationTables\Helper\Data::XML_PATH_PRODUCT_TAB_TITLE);
        	$result = trim($tabTitle) ? trim($tabTitle) : "Multiplication Table";
        }

        return $result;
    }
}