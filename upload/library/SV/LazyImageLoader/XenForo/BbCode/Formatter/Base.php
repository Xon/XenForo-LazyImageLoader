<?php

class SV_LazyImageLoader_XenForo_BbCode_Formatter_Base  extends XFCP_SV_LazyImageLoader_XenForo_BbCode_Formatter_Base
{
    static $lazy_imageTemplate = null;

    public function __construct()
    {
        parent::__construct();
        if (self::$lazy_imageTemplate === null)
        {
            self::$lazy_imageTemplate = '<img src="'.SV_LazyImageLoader_Helper::_getLoaderIcon().'" data-src="%1$s" class="bbCodeImage%2$s" alt="[&#x200B;IMG]" data-url="%3$s" /><noscript><img src="%1$s" /></noscript>';
        }
        $this->_imageTemplate = self::$lazy_imageTemplate;
    }
}