<?php

class SV_LazyImageLoader_XenForo_BbCode_Formatter_Base  extends XFCP_SV_LazyImageLoader_XenForo_BbCode_Formatter_Base
{
    static $lazy_imageTemplate = null;

    public function __construct()
    {
        parent::__construct();
        if (self::$lazy_imageTemplate === null)
        {
            $url = SV_LazyImageLoader_Helper::_getLoaderIcon();
            if ($url)
            {
                self::$lazy_imageTemplate = '<img src="'.$url.'" data-src="%1$s" class="bbCodeImage%2$s" alt="[&#x200B;IMG]" data-url="%3$s" style="display:none" /><noscript><img src="%1$s" /></noscript>';
            }
            else
            {
                self::$lazy_imageTemplate = false;
            }
        }
        if (self::$lazy_imageTemplate)
        {
            $this->_imageTemplate = self::$lazy_imageTemplate;
        }
    }
}