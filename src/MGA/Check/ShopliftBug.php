<?php
/**
 * Magento Guest Audit
 *
 * PHP version 5
 *
 * @author    Steve Robbins <steven.j.robbins@gmail.com>
 * @license   http://creativecommons.org/licenses/by/4.0/
 * @link      https://github.com/steverobbins/magento-guest-audit
 */

namespace MGA\Check;

use MGA\Request;

/**
 * Check for the Shoplift bug using the Magento API
 */
class ShopliftBug
{
    const MAGENTO_BASE_URL = 'https://magento.com/security-patch-check/';

    /**
     * Does API request based on a protocol-less URL.
     *
     * @param  string $url
     * @param  string $admin
     * @return array
     */
    public function check($url, $admin)
    {

        $request  = new Request;
        $response = $request->fetch(self::MAGENTO_BASE_URL.$url.$admin);

        $decode = null;
        if (property_exists($response, 'body')) {
            $decode = json_decode($response->body, true);
        } else {
            $decode = array('status' => 'error', 'message' => 'can\'t connect');
        }

        return $decode;
    }
}
