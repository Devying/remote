<?php
/**
 * Smarty.php
 *
 * @author  haungby
 * @date    2016-01-06 14:15
 * @version 1.0
 */
require "Smarty.class.php";


class Smarty_Adapter implements Yaf_View_Interface {
    /**
     * Smarty object
     * @var Smarty
     */
    public $_smarty;

    /**
     * Constructor
     *
     * @param string $tmplPath
     * @param array $extraParams
     * smarty 模板的配置参数
     * @return void
     */
    public function __construct ( $tmplPath = null, $extraParams = array () ) {
        $this->_smarty = new Smarty;
        if ( null !== $tmplPath ) {
            $this->setScriptPath ( $tmplPath );
        }

        foreach ( $extraParams as $key => $value ) {
            $this->_smarty->$key = $value;
        }

    }

    /**
     * Return the template engine object
     *
     * @return Smarty
     */
    public function getEngine () {
        return $this->_smarty;
    }

    /**
     * Set the path to the templates
     *
     * @param string $path The directory to set as the path.
     * @return void
     */
    public function setScriptPath ( $path ) {
        if ( is_readable ( $path ) ) {
            $this->_smarty->template_dir = $path;
            return;
        }

        throw new Exception( 'Invalid path provided' );
    }

    /**
     * Retrieve the current template directory
     *
     * @return string
     */
    public function getScriptPath () {
        return $this->_smarty->template_dir;
    }

    /**
     * Alias for setScriptPath
     *
     * @param string $path
     * @param string $prefix Unused
     * @return void
     */
    public function setBasePath ( $path, $prefix = 'Zend_View' ) {
         $this->setScriptPath ( $path );
    }

    /**
     * Alias for setScriptPath
     *
     * @param string $path
     * @param string $prefix Unused
     * @return void
     */
    public function addBasePath ( $path, $prefix = 'Zend_View' ) {
         $this->setScriptPath ( $path );
    }

    /**
     * Assign a variable to the template
     *
     * @param string $key The variable name.
     * @param mixed $val The variable value.
     * @return void
     */
    public function __set ( $key, $val ) {
        $this->_smarty->assign ( $key, $val );
    }

    /**
     * Allows testing with empty() and isset() to work
     *
     * @param string $key
     * @return boolean
     */
    public function __isset ( $key ) {
        return ( null !== $this->_smarty->getTemplateVars ( $key ) );
    }

    /**
     * Allows unset() on object properties to work
     *
     * @param string $key
     * @return void
     */
    public function __unset ( $key ) {
        $this->_smarty->clearAssign( $key );
    }

    /**
     * Assign variables to the template
     *
     * Allows setting a specific key to the specified value, OR passing
     * an array of key => value pairs to set en masse.
     *
     * @see __set()
     * @param string|array $spec The assignment strategy to use (key or
     * array of key => value pairs)
     * @param mixed $value (Optional) If assigning a named variable,
     * use this as the value.
     * @return void
     */
    public function assign ( $spec, $value = null ) {
        if ( is_array ( $spec ) ) {
            $this->_smarty->assign ( $spec );
            return;
        }

        $this->_smarty->assign ( $spec, $value );
    }

    public function render ( $tpl, $tpl_vars = null ) {
        return $this->_smarty->fetch( $tpl );
    }

    public function display($tpl, $tpl_vars = null) {
        $this->_smarty->display($tpl);
    }

}

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
?>
