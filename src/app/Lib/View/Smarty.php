<?php

namespace Vdemo\Lib\View;

class Smarty extends \Vine\Component\View\Base
{

    /**
     * Smarty object
     *
     * @var \Smarty
     */
    protected $smarty;

    /**
     * construct method
     * 
     * @param \Smarty $smarty
     */
    public function __construct(\Smarty $smarty)
    {
        $this->smarty = $smarty;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setViewRoot($viewRoot)
    {
        $this->viewRoot = rtrim($viewRoot, '/') . '/';
        $this->smarty->template_dir = $this->viewRoot;    
    }
    
    /**
     * {@inheritdoc}
     */
    public function assign($key, $value, $secureFilter=true)
    {
        if ($secureFilter) {
            if (is_array($value)) {
                array_walk_recursive($value, function (&$item, $key) {
                    if (is_string($item)) {
                        $item = htmlspecialchars($item);
                    }
                });
            } else if (is_string($value)) {
                $value = htmlspecialchars($value);
            }
        }
        
        $this->smarty->assign($key, $value);
    }
    
    /**
     * {@inheritdoc}
     */
    public function render($viewFile, $withViewSuffix = false, array $data = array())
    {
        $viewFile = $this->getViewFileWithViewRoot($viewFile, $withViewSuffix);
        
        // assin variable
        foreach ($data as $key => $value) {
            $this->assign($key, $value);
        }
        
        ob_start();
        $this->smarty->display($viewFile);
        return ob_get_clean();
    }
}
