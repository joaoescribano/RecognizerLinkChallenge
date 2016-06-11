<?php
/**
 * ShopBack Challange - Link Recognizer
 * @author João Escribano <joao.escribano@gmail.com>
 */
class Recognizer {
    private $store;
    private $products = [];
    private $badWords = ['campanha', 'p', 'id'];

    /**
     * Class constructor (auto initialization)
     */
    public function __construct($storeUrl = null) {
        if ($storeUrl !== null) {
            $this->loadProducts($storeUrl);
        }
    }

    /**
     * Load products from store XML
     */
    public function loadProducts($url = null) {

        /* Checks if the provided URL is valid */
        if ($url === null || !preg_match('/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/', $url)) {
            return false;
        }

        /* Store the clean URL of the store */
        $this->store = $url;
        
        /* Check if there is a store product XML */
        if (!is_file(dirname(__FILE__) . "/xmls/$url.xml")) {
            return false;
        }

        /* FIX: json encode/decode to normalize the array */
        $tmp = json_decode(json_encode(simplexml_load_file(dirname(__FILE__) . "/xmls/$url.xml")), true);

        /* Return treatment of the XML for further array key padronization */
        if (!array_key_exists(0, $tmp['item'])) {
            $tmp = [$tmp['item']];
        } else {
            $tmp = $tmp['item'];
        }

        /* Store products information */
        $this->products = $tmp;
    }

    /**
     * Tests the URL to check if it corresponds to a valid product URL
     */
    public function isProduct($visitedURL = null) {
        if ($visitedURL === null || $visitedURL == "") {
            return false;
        }

        /* Remove all GET parameters before test the URL */
        if (strstr($visitedURL, "?")) {
            $visitedURL = explode("?", $visitedURL)[0];
        }

        /* Test if the visited URL was sent correctly and if it is a valid URL */
        if (!preg_match('/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/', $visitedURL)) {
            return false;
        }

        // echo $visitedURL . "\n";

        /* URL Padronization */
        $visitedURL = str_replace(['http://', 'https://', "www.", $this->store], ['', '', '', ''], $visitedURL);
        if (substr($visitedURL, 0, 1) == '/') {
            $visitedURL = substr($visitedURL, 1);
        }

        /* Skip empty url's */
        if ($visitedURL == "") {
            return false;
        }

        /* Starts to build all regex patterns */
        $patterns = [];
        foreach ($this->products as $product) {
            $patterns[] = $product['id'];
            $patterns[] = $this->text2url($product['title']);
            $patterns[] = $this->text2url($product['title'], '-');

            /* Build the link patterns for testing */
            $tmpLink = str_replace(['http://', 'https://', "www.", $this->store], ['', '', '', ''], $product['link']);
            if (substr($tmpLink, 0, 1) == '/') {
                $tmpLink = substr($tmpLink, 1);
            }

            /* Skip empty links */
            if ($tmpLink == "") {
                continue;
            }

            /* Build product link pattern with underline */
            $tmpLink    = implode("|", explode("/", $this->text2url($tmpLink, " ")));
            $tmpLink    = explode("_", $tmpLink);

            foreach ($tmpLink as $key => $value) {
                if (strlen($value) > 1 && !in_array($value, $this->badWords)) {
                    $patterns[] = $value;
                }
            }
        }

        /* Test the patters to discover product pages */
        if (preg_match("/" . implode("|", $patterns) . "/", $visitedURL)) {
            return true;
        }

        return false;
    }

    /**
     * Convert the received text to the WEB default URL format
     */
    private function text2url($text = null, $spaceChar = '_', $tolower = true) {
        if ($text === null || $text == "") {
            return false;
        }

        $bad_chars = array("'", "\\", ' ', '/', ':', '*', '?', '"', '<', '>', '|', "+");
        $text = preg_replace('/[àáâãåäæ]/iu', 'a', $text);
        $text = preg_replace('/[èéêë]/iu', 'e', $text);
        $text = preg_replace('/[ìíîï]/iu', 'i', $text);
        $text = preg_replace('/[òóôõöø]/iu', 'o', $text);
        $text = preg_replace('/[ùúûü]/iu', 'u', $text);
        $text = preg_replace('/[ç]/iu', 'c', $text);
        $text = rawurlencode(str_replace($bad_chars, $spaceChar, $text));
        $text = preg_replace("/%(\w{2})/", '_', $text);
        $text = str_replace("__", "_", $text);

        if (substr($text, -1) == $spaceChar) {
            $text = substr($text, 0, -1);
        }

        return ($tolower === true) ? strtolower($text) : $text;
    }
}