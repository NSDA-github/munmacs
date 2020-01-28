<?php
class Countries
{
    public static function show()
    {
        readfile(__DIR__ . "/nav.html");
    }
    public static function getCountries()
    {
        $dom = new DOMDocument();
        $dom->loadHTMLFile("https://www.un.org/en/member-states/index.html");
        $finder = new DOMXPath($dom);
        $classname = "member-state-name";
        $nodes = $finder->query("//*[contains(@class, '$classname')]");

        $tmp_dom = new DOMDocument();

        //echo $elements;
        $countries = array();
        if (!is_null($nodes)) {
            foreach ($nodes as $node) {
                $val = $node->nodeValue;
                array_push($countries, $val);
            }
            echo json_encode($countries, JSON_UNESCAPED_UNICODE);
        } else {
            echo "Fail2";
        }
    }
}
