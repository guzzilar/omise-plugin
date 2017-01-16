<?php
namespace OmisePlugin\Contexts;

/**
 * @see https://github.com/omise/omise-php/blob/master/lib/omise/OmiseCharge.php;
 */
class OmiseChargeContext
{
    /**
     * @param  array $params
     *
     * @return \OmiseCharge
     */
    public function create($params)
    {
        $charge = \OmiseCharge::create($params);

        return $charge;
    }

    /**
     * @param  \OmiseCharge $charge
     *
     * @return bool
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
     */
    public function isPaid($charge)
    {
        $paid = isset($charge['paid']) ? $charge['paid'] : $charge['captured'];

        if ($charge['authorized'] && $paid) {
            return true;
        }

        return false;
    }

    /**
     * @param  \OmiseCharge $charge
     * @param  callable     $success_callback
     * @param  callable     $fail_callback
     *
     * @return mixed
     */
    public function validateAfter3DSecureProcess($charge, $success_callback = null, $fail_callback = null)
    {
        if (($charge['capture'] && $this->isPaid($charge))
            || (! $charge['capture'] && $this->isAuthorized($charge))
        ) {
            if (is_callable($success_callback)) return $success_callback($charge);

            return true;
        }

        if (is_callable($fail_callback)) return $fail_callback($charge);

        return false;
    }

    /**
     * @param  \OmiseCharge $charge
     *
     * @return bool
     */
    public function need3DSecureProcess($charge)
    {
        $paid = isset($charge['paid']) ? $charge['paid'] : $charge['captured'];

        if ($charge['status'] === 'pending'
            && ! $charge['authorized']
            && ! $paid
            && $charge['source_of_fund'] === 'card'
            && isset($charge['authorize_uri'])
            && $charge['authorize_uri'] != null
        ) {
            return true;
        }

        return false;
    }
}
