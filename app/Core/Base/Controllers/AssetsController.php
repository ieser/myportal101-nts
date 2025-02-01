<?php
namespace Core\Base\Controllers;
class AssetsController {

    public function __construct() {
    }

    public function serve() {
        ob_start();

        $module = \Helpers::param("module");
        $file = \Helpers::param("file");
        $basePaths = [
            APP_PATH . '/Modules/' . ucfirst($module) . '/Assets/',
            APP_PATH . '/Core/' . ucfirst($module) . '/Assets/'
        ];

        $assetPath = null;

        foreach ($basePaths as $path) {
            if (file_exists($path . $file)) { //File founded
                $assetPath = $path . $file;
                break;
            }
        }

        if ($assetPath) {
            $ext = pathinfo($assetPath, PATHINFO_EXTENSION);

            $mimeTypes = [ 'css'  => 'text/css', 'js'   => 'application/javascript', 'png'  => 'image/png', 'jpg'  => 'image/jpeg', 'jpeg' => 'image/jpeg', 'gif'  => 'image/gif', 'woff' => 'font/woff', 'woff2'=> 'font/woff2', 'ttf'  => 'font/ttf', 'otf'  => 'font/otf', 'svg'  => 'image/svg+xml'];
            $mimeType = $mimeTypes[$ext] ?? 'application/octet-stream';

            \Helpers::header('Content-Type', $mimeType);
            \Helpers::header('Content-Length', filesize($assetPath));
            \Helpers::header('Cache-Control', 'public, max-age=3600');
            readfile($assetPath);
        } else {
            \Helpers::error(404, "Asset non trovato: {$file}");
        }

        ob_end_flush();
        
    }

}
