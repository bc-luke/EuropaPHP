<?php

namespace Europa\View\Helper;

/**
 * A helper for generating JavaScript script tags.
 * 
 * @category Helpers
 * @package  Europa
 * @author   Trey Shugart <treshugart@gmail.com>
 * @license  Copyright (c) 2011 Trey Shugart http://europaphp.org/license
 */
class Json
{
    /**
     * The PHP view variables to register for JavaScript.
     * 
     * @var array
     */
    private $vars = array();
    
    /**
     * The namespace to register the variables under.
     * 
     * @var string
     */
    private $ns = null;
    
    /**
     * Registers variables to be passed from the view to JavaScript.
     * 
     * @param array $vars The variables to pass to JavaScript.
     * @param array $ns   The namespace to use.
     * 
     * @return \Europa\View\Helper\Json
     */
    public function __construct(array $vars, $ns = null)
    {
        $this->vars = $vars;
        $this->ns   = $ns;
    }
    
    /**
     * Returns a JSON representation of the specified variables in the specified namespace.
     * 
     * @return string
     */
    public function __toString()
    {
    	$js = '';
    	$ns = 'window';
    	
    	if ($this->ns) {
    	    foreach (explode('.', $this->ns) as $subNs) {
    	        $ns .= '[' . $subNs . ']';
    	        $js .= $ns . ' = {};' . PHP_EOL;
    	    }
    	}
    	
    	foreach ($this->vars as $name => $value) {
    	    $js .= $ns . '[' . json_encode($name) . '] = ' . $this->toJson($value) . ';' . PHP_EOL;
    	}
    	
    	return $js;
    }
    
    /**
     * Converts any variable to JSON format making sure that it can be converted before doing the conversion.
     * 
     * @param mixed $any Any type of value to be converted to JSON format.
     * 
     * @return string
     */
    private function toJson($any)
    {
    	return json_encode($this->makeJsonEncodable($any));
    }

    /**
     * Makes sure that the passed in value can be JSON encoded. This includes any object instance that may be
     * traversable. If the value is not an array or object, it is simply passed through.
     * 
     * @param mixed $any Any type of value to convert to a JSON encodable array.
     * 
     * @return mixed
     */
    private function makeJsonEncodable($any)
    {
    	if (is_array($any) || is_object($any)) {
    	    $arr = array();
    		foreach ($any as $i => $v) {
    		    $arr[$i] = $this->makeJsonEncodable($v);
    		}
    		$any = $arr;
    	}
    	
    	return $any;
    }
}