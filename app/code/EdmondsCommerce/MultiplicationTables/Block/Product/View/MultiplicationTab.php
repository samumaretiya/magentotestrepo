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

namespace EdmondsCommerce\MultiplicationTables\Block\Product\View;

use Magento\Catalog\Model\Product;

/**
 * @api
 * @since 100.0.2
 */
class MultiplicationTab extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Product
     */
    protected $_product = null;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \EdmondsCommerce\MultiplicationTables\Helper\Data $dataHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \EdmondsCommerce\MultiplicationTables\Helper\Data $dataHelper,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_dataHelper = $dataHelper;
        parent::__construct($context, $data);
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        if (!$this->_product) {
            $this->_product = $this->_coreRegistry->registry('product');
        }
        return $this->_product;
    }

    /**
     * @param \Magento\Catalog\Model\Product $product
     * @return boolean
     */
    public function isVisibleMultiplicationTable(\Magento\Catalog\Model\Product $product)
    {
        error_log("\n == ",3,BP."/var/log/axis.log");
        
        if(!$this->_dataHelper->getConfigValue(\EdmondsCommerce\MultiplicationTables\Helper\Data::XML_PATH_MODULE_IS_ENABLED)) {
            return false;
        }
        $xAxis = $product->getXAxis();
        $yAxis = $product->getYAxis();
        error_log("\n".$xAxis." == ".$yAxis,3,BP."/var/log/axis.log");
        if($xAxis && $yAxis && \EdmondsCommerce\MultiplicationTables\Helper\Data::isValidInteger($xAxis) && \EdmondsCommerce\MultiplicationTables\Helper\Data::isValidInteger($yAxis)) {
            return true;
        }
        return false;
    }
}
