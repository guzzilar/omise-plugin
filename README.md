# Omise Plugin

Plugin for [Omise-PHP](http://github.com/omise/omise-php)

## Installation Instruction

1. Get [composer](http://getcomposer.org)
1. run `composer install` to install [Omise-PHP](http://github.com/omise/omise-php) (v2.6.0)

## Contexts

1. [OmisePlugin\Contexts\OmiseChargeContext](#omisechargecontext)

## OmiseChargeContext

**namespace:** OmisePlugin\Contexts\OmiseChargeContext

  - **create($params)**  

    **example**

    ```php
    $charge = \OmisePlugin\Repository::create('OmiseCharge', $params);

    if ($charge->isPaid()) {
        // success
    } else {
        // fail
    }
    ```

  - **isAuthorized()**

    **example**

    ```php
    $charge = OmiseCharge::retrieve('chrg_id');
    $charge = \OmisePlugin\Repository::add($charge);

    if ($charge->isAuthorized()) {
        // success
    } else {
        // fail
    }
    ```

  - **isPaid()**

    **example**

    ```php
    $charge = OmiseCharge::retrieve('chrg_id');
    $charge = \OmisePlugin\Repository::add($charge);

    if ($charge->isPaid()) {
        // success
    } else {
        // fail
    }
    ```
