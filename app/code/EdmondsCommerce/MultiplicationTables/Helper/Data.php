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

namespace EdmondsCommerce\MultiplicationTables\Helper;

/**
 * Data Helper
 *
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_PATH_MODULE_IS_ENABLED = "multiplication_table/general/enabled";

    const XML_PATH_PRODUCT_TAB_TITLE = "multiplication_table/general/tab_title";

	/**
     * Validate Given Number is Positive integer or not
     *
     * @param string $number
     * @return boolean
     * 
     */
    public static function isValidInteger($number = "") {
    	$filter_options = array( 
		    'options' => array('min_range' => 1) 
		);

		if(filter_var($number, FILTER_VALIDATE_INT, $filter_options) !== FALSE) {
		   	return true;
		}
		return false;
    }

    /**
     * get Core Config Data based on Path
     *
     * @param string $config_path
     * @return string
     * 
     */
    public function getConfigValue($config_path)
    {
        return $this->scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}