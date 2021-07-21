<?php


namespace App\Http\Controllers\Parsers;


use App\Http\Controllers\Controller;
//use Goutte\Client;
//use Symfony\Component\DomCrawler\Crawler;
//use Symfony\Component\HttpClient\HttpClient;




class Curl extends Controller
{

    public static function getHTML($nodeShort){
        $headers = array(
            'cache-control: max-age=0',
            'upgrade-insecure-requests: 1',
            'user-agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36',
            'sec-fetch-user: ?1',
            'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
            'x-compress: null',
            'sec-fetch-site: none',
            'sec-fetch-mode: navigate',
            'accept-encoding: deflate, br',
            'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
        );

        $user_cookie_file = $_SERVER['DOCUMENT_ROOT'].'/cookie.txt';

        $ch = curl_init('https://fermer.ru/board?title=&type_1%5B%5D=sale&type_1%5B%5D=tender'.$nodeShort);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $user_cookie_file);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $user_cookie_file);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        $html = curl_exec($ch);
        curl_close($ch);

        return $html;
    }





    public static function curl_get_contents($page_url, $base_url, $pause_time, $retry) {
        /*
        $page_url - адрес страницы-источника
        $base_url - адрес страницы для поля REFERER
        $pause_time - пауза между попытками парсинга
        $retry - 0 - не повторять запрос, 1 - повторить запрос при неудаче
        */
        $error_page = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_ENCODING, "utf-8");
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0");
        curl_setopt($ch, CURLOPT_COOKIEJAR, str_replace("\\", "/", getcwd()).'/gearbest.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, str_replace("\\", "/", getcwd()).'/gearbest.txt');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // Автоматом идём по редиректам
//        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); // Не проверять SSL сертификат
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0); // Не проверять Host SSL сертификата
        curl_setopt($ch, CURLOPT_URL, $page_url); // Куда отправляем
        curl_setopt($ch, CURLOPT_REFERER, $base_url); // Откуда пришли
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Возвращаем, но не выводим на экран результат
        $response['html'] = curl_exec($ch);
        $info = curl_getinfo($ch);
        if($info['http_code'] != 200 && $info['http_code'] != 404) {
            $error_page[] = array(1, $page_url, $info['http_code']);
            if($retry) {
                sleep($pause_time);
                $response['html'] = curl_exec($ch);
                $info = curl_getinfo($ch);
                if($info['http_code'] != 200 && $info['http_code'] != 404)
                    $error_page[] = array(2, $page_url, $info['http_code']);
            }
        }
        $response['code'] = $info['http_code'];
        $response['errors'] = $error_page;
        curl_close($ch);
        return $response['html'];

    }

}
