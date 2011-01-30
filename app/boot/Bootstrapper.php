<?php

// autoloading isn't enabled yet, so required the bootstrapper
require_once dirname(__FILE__) . '/../../lib/Europa/Bootstrapper.php';

/**
 * Bootstraps the sample application.
 * 
 * @category Bootstrapping
 * @package  Europa
 * @author   Trey Shugart <treshugart@gmail.com>
 * @license  Copyright (c) 2010 Trey Shugart http://europaphp.org/license
 */
class Bootstrapper extends Europa\Bootstrapper
{
    /**
     * The application base path.
     * 
     * @var string
     */
    private $base;
    
    /**
     * Sets error reporting.
     * 
     * @return void
     */
    public function setErrorReporting()
    {
        error_reporting(E_ALL ^ E_STRICT);
        ini_set('display_errors', 'on');
    }
    
    /**
     * Sets the base path.
     * 
     * @return void
     */
    public function setBasePath()
    {
        $this->base = realpath(dirname(__FILE__) . '/../../');
    }
    
    /**
     * Requires the loader.
     * 
     * @return void
     */
    public function requireLoader()
    {
        require $this->base . '/lib/Europa/Loader.php';
    }
    
    /**
     * Adds load paths to the loader for autoloading.
     * 
     * @return void
     */
    public function addLoadPaths()
    {
        \Europa\Loader::addPath($this->base . '/app/controllers');
        \Europa\Loader::addPath($this->base . '/app/views');
        \Europa\Loader::addPath($this->base . '/app/helpers');
        \Europa\Loader::addPath($this->base . '/app/filters');
        \Europa\Loader::addPath($this->base . '/app/forms');
    }
    
    /**
     * Registers autoloading.
     * 
     * @return void
     */
    public function registerAutoloading()
    {
        \Europa\Loader::registerAutoload();
    }
}