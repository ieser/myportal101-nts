<?php
namespace Core\Base\Controllers;
class WebpageController  {
    
    public $title = '', $breadcrumbs = [];
    public $metatitle, $metadescription, $metakeywords;
    public $javascript = [];
    public $stylesheet = [];
    public $content = [];
    
    
    
    
    
    public function __construct($module){
        $modulepath =  APP_PATH.'/'.$module;
        
        $config = include $modulepath.'/config.php';
        
        if (!isset($config['need-authentication']) OR !( $config['need-authentication'] == false) ){
            \AuthenticationHelpers::checkAuthentication();
        }

        if (file_exists($modulepath."/Dict/")) {
            \LanguagesHelpers::addDictionary($modulepath."/Dict/");
        }

        if (is_dir($modulepath."/Views/")) {
            \Helpers::set('UI', $modulepath."/Views/");
        }


        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            
            $layout = [
                "open" => "OpenLayout.php",
                "authentication" => "AuthenticationLayout.php",
                "reserved" => "ReservedLayout.php",
            ];
            $layout = $layout[$config['layout']] ?? $layout["open"];
            
            \Helpers::set('UI', APP_PATH . "/Core/Base/Views/"); 
            echo  \View::instance()->render($layout, 'text/html');
            die();
        }
        
    }
    
    
   
    
    public function setTitle($title){
        $this->title = $title;
    }
        
    public function setBreadcrumbs($breadcrumbs){
        $this->breadcrumbs = $breadcrumbs;
    }
    
    public function setMetatitle($metatitle){
        $this->metatitle = $metatitle;
    }
    
    public function setMetadescription($metadescription){
        $this->metadescription = $metadescription;
    }
        
    public function setMetakeywords($metakeywords){
        $this->metakeywords = $metakeywords;
    }
        
    public function addJavascript($javascript){
        $this->javascript[] = $javascript;
    }
    
    public function addStylesheet($stylesheet){
        $this->stylesheet[] = $stylesheet;
    }
    

    public function addContent($content) {
        $this->content[] = $content;
    }
    
    public function renderContent() {
    }
    
    public function send(){
        $renderedContent = '';
        foreach($this->content as $content){
            $renderedContent .= \View::instance()->render($content, 'text/html');
        }
        $response = [
            'content' => $renderedContent,
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
            'metatitle' => $this->metatitle,
            'metadescription' => $this->metadescription,
            'metakeywords' => $this->metakeywords,
            'javascript' => $this->javascript,
            'stylesheet' => $this->stylesheet
        ];
        echo json_encode($response);
    }
    
}