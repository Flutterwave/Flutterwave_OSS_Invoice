<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16-Apr-18
 * Time: 01:26 PM
 */

namespace App\Http\Utils\Traits;

use GuzzleHttp\Exception\BadResponseException;

trait Send
{

    public function send($type, $params)
    {
        if (stripos(self::$url, '/borrow') !== false)
            $params = $this->setBorrParams($type, $params);
        else if (stripos(self::$url, '/lend') !== false)
            $params = $this->setInvParams($type, $params);
        else if (stripos(self::$url, '/asset') !== false)
            $params = $this->setAssetParams($type, $params);

        $params = array_merge(['type' => $type], $params);

        try {
            $res = self::$client->post(self::$url, [
                "form_params" => $params
            ]);
        } catch (BadResponseException $e) {
            $res = json_decode($e->getResponse()->getBody()->getContents(), true);
            if (empty($res)) $res = $e->getMessage();
            return $res;
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return json_decode($res->getBody()->getContents(), true);
    }
}