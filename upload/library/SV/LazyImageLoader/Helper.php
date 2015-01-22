<?php

class SV_LazyImageLoader_Helper
{
    public static function getLazySpinnerUrl($content, $params, XenForo_Template_Abstract $template)
    {
        return SV_LazyImageLoader_Helper::_getLoaderIcon();
    }

    static $lazy_loader_icon = null;
    
    public static function _getLoaderIcon()
    {
        if (empty(SV_LazyImageLoader_Helper::$lazy_loader_icon))
        {
            $options = XenForo_Application::get("options");
            $boardUrl = $options->boardUrl;
            
            $spinnerURL =  $options->SV_LazyLoaderSpinner;
            if ($spinnerURL == '')
            {
                $spinnerURL = $boardUrl;
            }
            
            if (strpos($spinnerURL, '://') === false && strpos($spinnerURL,'/') !== 0)
            {
                $spinnerURL = $spinnerURL.'/styles/SV/LazyImageLoader/loader.gif';
            }
            
            SV_LazyImageLoader_Helper::$lazy_loader_icon = $spinnerURL;
        }
        return SV_LazyImageLoader_Helper::$lazy_loader_icon;
    }
}