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

namespace EdmondsCommerce\MultiplicationTables\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Sales\Api\OrderStatusHistoryRepositoryInterface;
use Psr\Log\LoggerInterface;

class AddDimentionsOrderComment implements \Magento\Framework\Event\ObserverInterface
{
	/** @var LoggerInterface */
    private $logger;

    /** @var OrderStatusHistoryRepositoryInterface */
    private $orderStatusRepository;

    public function __construct(
        OrderStatusHistoryRepositoryInterface $orderStatusRepository,
        LoggerInterface $logger,
        \EdmondsCommerce\MultiplicationTables\Helper\Data $dataHelper
    ) {
        $this->orderStatusRepository = $orderStatusRepository;
        $this->logger = $logger;
        $this->_dataHelper = $dataHelper;
    }

	/**
     * Add Order Comment After Placing an Order
     *
     * @param EventObserver $observer
     * @return $this
     */
    public function execute(EventObserver $observer)
    {
        if(!$this->_dataHelper->getConfigValue(\EdmondsCommerce\MultiplicationTables\Helper\Data::XML_PATH_MODULE_IS_ENABLED)) {
            return $this;
        }
    	$_order = $observer->getEvent()->getOrder();
    	if($_order && $_order->getId()) {
    		$_orderItems = $_order->getAllVisibleItems();
    		$orderComments = [];
    		foreach($_orderItems as $_item) {
    			$_product = $_item->getProduct();
    			if($_product && $_product->getId()) {
    				$xAxis = (int) $_product->getXAxis();
    				$yAxis = (int) $_product->getYAxis();
    				if($xAxis && $yAxis) {
    					$orderComments[] = __(
    							"%1 was ordered with these dimensions %2(X-Axis) by %3(Y-Axis).",
    							$_product->getName(),
    							$xAxis,
    							$yAxis
    						);
    				}
    			}
    		}

    		if($orderComments && !empty($orderComments)) {
    			$comment = $_order->addStatusHistoryComment(
	                implode("<br />", $orderComments)
	            );
	            try {
                	$orderHistory = $this->orderStatusRepository->save($comment);
	            } catch (\Exception $exception) {
	                $this->logger->critical($exception->getMessage());
	            }
    		}
    	}
        return $this;
    }
}