<?php
namespace Core\Base;
class Bootstrap{
    
    protected $f3, $db;
    protected $modules;

    public function __construct(){
        
        $this->f3 = \Base::instance();
        $this->setupConfig();
        $this->setupSession();
        $this->setupModules();
        $this->setupRoutes();
        $this->setupHelpers();     
        \Core\Languages\Middleware\LanguageMiddleware::setup();        
    }
    

    
    protected function setupConfig(){
        define('APP_PATH', dirname(__DIR__, 2));

        $this->f3->config(APP_PATH."/Config/config.ini");
        $this->f3->set('AUTOLOAD', APP_PATH.'/');
        $this->f3->set('CACHE', false);
        $this->f3->set('UPLOADS', 'uploads');
        $this->f3->set('DEBUG',3 );

     
        $this->f3->set('UI.minify', 'true');
        $this->f3->set('WEB.compress', 'true');
        
        
        
    }
    
    protected function setupModules(){
        $folders = [ 'Core', 'Modules' ];
        foreach ($folders as  $folder) {
            $path = APP_PATH . '/'.$folder;
            $modules = glob($path. '/*');
            foreach ($modules as $module) {
                if (is_dir($module)) {
                    $name  = end(explode('/', $module));
                    $namespace  = $folder.'\\'.$name;
                    $moduledata = [
                        "name" => $name,
                        "namespace" => $namespace,
                        "path" => $module
                    ];
                    $this->modules[] = $moduledata;
                }
            }
        }
    }


    protected function setupRoutes(){
        foreach ($this->modules as $module) {
            $routesPath = $module["path"] . '/Routes';
            if (is_dir($routesPath)) {
                foreach (glob($routesPath . '/*.php') as $routeFile) {
                    require_once $routeFile; 
                }
            }
        }
    }

    public function setupHelpers(){
        
        
        foreach (glob(APP_PATH.'/Core/Base/Helpers/*.php') as $coreHelper) {
            require_once $coreHelper; 
            $className = basename($coreHelper, '.php');
            if($className == "UtilsHelpers"){
                class_alias('Core\Base\Helpers\UtilsHelpers', 'Helpers');  
            }else{
                class_alias('Core\Base\Helpers\\' . $className, $className);  
            }
        }
        foreach ($this->modules as $module) {
            $aliasClass = $module["name"] . 'Helpers';
            
            $helperClassFile = $module["path"] . '/Helpers/'.$module["name"] . 'Helpers.php';
            $helperClass =  '\\'.$module["namespace"].'\\Helpers\\'.$module["name"].'Helpers';
            if (file_exists($helperClassFile)) {
                if (!class_exists($helperClass)) {
                   // require_once($helperClassFile);
                }
                if (class_exists($helperClass)) {
                    $helperClass;
                    $aliasClass;
                    class_alias($helperClass, $aliasClass, true);
                }
            }
        }
    }


    protected function setupSession(){
        //AuthenticationModel::createTokenTableIfNotExists();
        //MouldWarrantyModel::createMouldWarrantyTableIfNotExists();
    }

    public function run(){
        $this->f3->run();
    }
}