<?php
namespace OmisePlugin\Contexts;

class OmiseChargeContext
{
    /**
     * @param  \OmiseCharge $charge
     *
     * @return bool
     *
     * @see    https://github.com/omise/omise-php/blob/master/lib/omise/OmiseCharge.php;
     */
    public function isAuthorized($charge)
    {
        if ($charge['authorized']) {
            return true;
        }

        return false;
    }

    /**
     * @param  \OmiseCharge $charge
     *
     * @return bool
     *
     * @see    https://github.com/omise/omise-php/blob/master/lib/omise/OmiseCharge.php;
     */
    public function isPaid($charge)
    {
        $paid = isset($charge['paid']) ? $charge['paid'] : $charge['captured'];

        if ($charge['authorized'] && $paid) {
            return true;
        }

        return false;
    }

    public function create($params)
    {
        $charge = \OmiseCharge::create($params);

        return $charge;
    }
}
