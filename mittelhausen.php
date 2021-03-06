<?php
// Mittelhausen extension, https://github.com/pftnhr/mittelhausen

class YellowMittelhausen {
    const VERSION = "0.8.13";
    public $yellow;         // access to API
    
    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
    }
    
    // Handle update
    public function onUpdate($action) {
        $fileName = $this->yellow->system->get("coreExtensionDirectory").$this->yellow->system->get("coreSystemFile");
        if ($action=="install") {
            $this->yellow->system->save($fileName, array("theme" => "mittelhausen"));
        } elseif ($action=="uninstall" && $this->yellow->system->get("theme")=="mittelhausen") {
            $theme = reset(array_diff($this->yellow->system->getValues("theme"), array("mittelhausen")));
            $this->yellow->system->save($fileName, array("theme" => $theme));
        }
    }

    // Handle page extra data
    public function onParsePageExtra($page, $name) {
        $output = null;
        if ($name=="header") {
            $themeLocation = $this->yellow->system->get("coreServerBase").$this->yellow->system->get("coreThemeLocation");
            $output .= "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"{$themeLocation}mittelhausen-custom.css\" />\n";
        }
        return $output;
    }
}
