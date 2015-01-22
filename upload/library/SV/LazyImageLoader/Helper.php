<?php

class SV_LazyImageLoader_Helper
{
    public static function getLazySpinnerUrl($content, $params, XenForo_Template_Abstract $template)
    {
        if (SV_LazyImageLoader_Helper::$enable_lazyloading)
        {
            $url = SV_LazyImageLoader_Helper::_getLoaderIcon();

            if ($url)
            {
                return 'src="' . $url . '" data-src="' . $params . '"';
            }
        }

        return 'src="' . $params . '"';
    }

    static $lazy_loader_icon = null;
    static $enable_lazyloading = null;

    public static function SetLazyLoadEnabled($value)
    {
        SV_LazyImageLoader_Helper::$enable_lazyloading = $value;
    }

    public static function IsLazyLoadEnabled()
    {
        return SV_LazyImageLoader_Helper::$enable_lazyloading;
    }

    public static function _getLoaderIcon()
    {
        if (SV_LazyImageLoader_Helper::$lazy_loader_icon === null)
        {
            if (SV_LazyImageLoader_Helper::$enable_lazyloading === null && XenForo_Application::get("options")->SV_LazyLoader_EnableDefault)
            {
                SV_LazyImageLoader_Helper::$enable_lazyloading = true;
            }
        
            if (SV_LazyImageLoader_Helper::IsLazyLoadEnabled()) 
            {        
                $options = XenForo_Application::get("options");
                $boardUrl = $options->boardUrl;

                $spinnerURL =  $options->SV_LazyLoader_Spinner;
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
            else
            {
                SV_LazyImageLoader_Helper::$lazy_loader_icon = false;
            }
        }
        return SV_LazyImageLoader_Helper::$lazy_loader_icon;
    }
}