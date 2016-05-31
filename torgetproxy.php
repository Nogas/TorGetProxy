<?php
namespace TorGetProxy;

use Curl\Curl;

require_once('vendor/autoload.php');


class Proxy
{
    public static function getTxtProxyList()
    {
        $url = 'http://proxy-ip-list.com/download/free-proxy-list.txt';
        $curl = new Curl();
       // $curl->setUserAgent('Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        $curl->get($url);
        if (!$curl->error) {
            $html = $curl->response;
        } else {
            echo 'CURL error: ' . $curl->error_code . ' ' . $curl->error_message . "\n";
            return false;
        }
        return $html;
    }

    public static function getProxyArray($text='')
    {
        preg_match_all('/(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}.+?);/', $text, $matches);
        if (isset($matches[1]))
        {
            if (sizeof($matches[1]))
            {
                return $matches[1];
            }
        }
        return false;
    }
}

print_R(Proxy::getProxyArray(Proxy::getTxtProxyList()));