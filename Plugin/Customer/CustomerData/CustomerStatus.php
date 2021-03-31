<?php

namespace Icreative\CustomerStatus\Plugin\Customer\CustomerData;

use Magento\Customer\CustomerData\Customer;
use Magento\Customer\Helper\Session\CurrentCustomer;

class CustomerStatus
{
    /**
     * @var CurrentCustomer
     */
    protected $currentCustomer;

    /**
     * @param CurrentCustomer $currentCustomer
     */
    public function __construct(
        CurrentCustomer $currentCustomer
    ) {
        $this->currentCustomer = $currentCustomer;
    }

    /**
     * @param Customer $subject
     * @param array $result
     * @return array
     */
    public function afterGetSectionData(Customer $subject, $result)
    {
        if (!empty($result)) {
            $customer = $this->currentCustomer->getCustomer();

            if ($status = $customer->getCustomAttribute('customer_status')) {
                $result = array_merge($result, ['status' => $status->getValue()]);
            }
        }

        return $result;
    }
}
