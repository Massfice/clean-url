<?php

namespace Massfice\CleanUrl;

class CleanUrl {

    private $cleans;

    public function __construct() {
        $uri = $_SERVER["REQUEST_URI"];
        $script = $_SERVER["SCRIPT_NAME"]."/";

        $clean = "";

        for($i = 0; $i < strlen($uri); $i++) {
            if(!isset($script[$i]) || $script[$i] != $uri[$i]) $clean = $clean.$uri[$i];
        }

        $cleans = $clean == "" ? [] : explode("/",$clean);

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