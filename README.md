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
    $params = array(
        'amount' => 10000,
        'card' => 'tokn_test_generated_by_omise',
        'currency' => 'thb'
    );
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
    $charge = \OmiseCharge::retrieve('chrg_id');
    $charge = \OmisePlugin\Repository::add($charge);

    if ($charge->isAuthorized()) {
        // success
    } else {
        // fail
    }
    ```

  - **need3DSecureProcess()**

    **example**

    ```php
    $params = array(
        'amount' => 10000,
        'card' => 'tokn_test_generated_by_omise',
        'currency' => 'thb'
    );
    $charge = \OmisePlugin\Repository::create('OmiseCharge', $params);

    if ($charge->need3DSecureProcess()) {
        // redirect
    } else {
        // do nothing. Or maybe you can check,
        // $charge->isPaid();
    }
    ```

  - **validateAfter3DSecureProcess($success_callback, $fail_callback)**

    **example**

    ```php
    // After buyer was redirected back by the 3-D Secure process.
    // You can check the result by the following code.
    $your_db_connection_object = DB::Connection();

    $charge = OmiseCharge::retrieve('chrg_id');
    $charge = \OmisePlugin\Repository::add($charge);

    $charge->validateAfter3DSecureProcess(
        function($charge) use ($your_db_connection_object) {
            // Update record as success.
            // $your_db_connection_object->update('status', 'success');
        },
        function($charge) use ($your_db_connection_object) {
            // Update record as failed.
            // $your_db_connection_object->update('status', 'failed');
        },
    );
    ```
