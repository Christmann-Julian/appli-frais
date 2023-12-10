<?php

/**
 * Controller
 * 
 * Controller is a controller
 * 
 * @author Julian CHRISTMANN
 * @package jtg/appli-frais
 */

namespace App\Controllers;

class Controller
{
  
    /**
     * Require the views associate with the path
     * 
     * @param string  $path
     * @param array   $data
     *
     * @return self
     */
    public function render(string $path, array $data = []):self
    {
        extract($data);
        ob_start();
        require 'views/'.$path;
        $content = ob_get_clean();
        require 'views/default.php';
        return $this;
    }

    /**
     * Generate a link to a route
     * 
     * @param string    $routeName
     * @param array     $params
     *
     * @return string
     */
    public function linkTo(string $routeName, ?string $params = null):string
    {
        if($params == null){
            return '?page='.$routeName;
        }else{
            return '?page='.$routeName.'&'.$params;
        }
        
    }
}