<?php

namespace Massfice\CleanUrl;

class CleanUrl {

    private $cleans;

    public function __construct() {
        $uri = $_SERVER["REQUEST_URI"];
        $script = $_SERVER["SCRIPT_NAME"]."/";

        $scripts = explode("/",$script);
        $uris = explode("/",$uri);

        $cleans = [];

        for($i = 0; $i < count($uris); $i++) {
            if(!isset($scripts[$i]) || $uris[$i] != $scripts[$i]) {
                $cleans[] = $uris[$i];
            }
        }

        $this->cleans = $cleans;

    }

    public function get(int $index, bool $getSpecial = true) : ?string {

        if(!$getSpecial) $index = $index + 2;

        if(isset($this->cleans[$index])) return $this->cleans[$index];
        return null;
    }

    public function getType() : string {
        return isset($this->cleans[1]) ? $this->cleans[1] : "";
    }

    public function getAction() : string {
        return isset($this->cleans[0]) ? $this->cleans[0] : "";
    }
}

?>