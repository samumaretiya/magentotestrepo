<?php
/**
 * EdmondsCommerce
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the www.edmondscommerce.com license that is
 * available through the world-wide-web at this URL:
 * http://www.edmondscommerce.com/license
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category   EdmondsCommerce
 * @package    EdmondsCommerce_MultiplicationTables
 * @copyright  Copyright (c) 2022 EdmondsCommerce (http://www.edmondscommerce.com/)
 * @license    http://www.edmondscommerce.com/LICENSE-1.0.html
 */

namespace EdmondsCommerce\MultiplicationTables\Plugin\Model\Product;

class AfterValidator 
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
     * Validate product data
     *
     * @param \Magento\Catalog\Model\Product\Validator $subject
     * @param boolean | array $results
     * @param \Magento\Catalog\Model\Product $product
     * @param RequestInterface $request
     * @param \Magento\Framework\DataObject $response
     * @return boolean | array
     * 
     */
    public function afterValidate(
    	\Magento\Catalog\Model\Product\Validator $subject,
    	$results,
    	\Magento\Catalog\Model\Product $product, 
    	\Magento\Framework\App\RequestInterface $request, 
    	\Magento\Framework\DataObject $response
    ) {
        if(!$this->_dataHelper->getConfigValue(\EdmondsCommerce\MultiplicationTables\Helper\Data::XML_PATH_MODULE_IS_ENABLED)) {
            return $results;
        }
        
    	$isValid = true;
    	$params = $request->getParam("product", []);
    	$xAxis = $yAxis = "";
    	
        /* Check whether X-Axis is Positive Integer or not */
        if($params && isset($params["x_axis"]) && $params["x_axis"]) {
    		$xAxis = $params["x_axis"];
    		if(!\EdmondsCommerce\MultiplicationTables\Helper\Data::isValidInteger($params["x_axis"])) {
    			$isValid = false;
    		}
    	}
    	
        /* Check whether Y-Axis is Positive Integer or not */
        if($isValid && $params && isset($params["y_axis"]) && $params["y_axis"]) {
    		$yAxis = $params["y_axis"];
    		if(!\EdmondsCommerce\MultiplicationTables\Helper\Data::isValidInteger($params["y_axis"])) {
    			$isValid = false;
    		}
    	}

        /* Check whether Any one Attribute is blank or not */
        if(($xAxis && !$yAxis) || (!$xAxis && $yAxis)) {
            $isValid = false;
        }

    	if(!$isValid) {
	    	$message = __("Please make sure that values of Attributes(X-Axis and Y-Axis) shoud be: (Both set as positive integers) or (Neither are set).");
	    	$eavExc = new \Magento\Eav\Model\Entity\Attribute\Exception($message);
	    	$eavExc->setAttributeCode("y_axis");
	    	throw $eavExc;
	    }
	    return $results;
    }
}