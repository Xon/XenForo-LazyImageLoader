<?php

class SV_LazyImageLoader_Helper
{
    public static function getLazySpinnerCss($content, $params, XenForo_Template_Abstract $template)
    {
        if (SV_LazyImageLoader_Helper::$enable_lazyloading)
        {
            $css = SV_LazyImageLoader_Helper::_getLoaderCss();

            if ($css)
            {
                return  $css;
            }
        }

        return '';
    }

    public static function getLazySpinnerUrl($content, $params, XenForo_Template_Abstract $template)
    {
        if (SV_LazyImageLoader_Helper::$enable_lazyloading)
        {
            $url = SV_LazyImageLoader_Helper::_getLoaderIcon();

            if ($url)
            {
                return  $url . '" data-src="' . $params ;
            }
        }

        return $params;
    }

    static $lazy_loader_icon = null;
    static $lazy_loader_css = null;
    static $enable_lazyloading = null;
    static $WasLazyLoadUsed = false;

    protected static function InstallTemplateHelper()
    {
        if (!isset(XenForo_Template_Helper_Core::$helperCallbacks['lazyloadstatus']))
        {
            XenForo_Template_Helper_Core::$helperCallbacks['lazyloadstatus'] = array('SV_LazyImageLoader_Helper', 'WasLazyLoadUsed');
        }
    }

    public static function WasLazyLoadUsed()
    {
        return self::$WasLazyLoadUsed;
    }

    public static function SetLazyLoadEnabled($value)
    {
        SV_LazyImageLoader_Helper::$enable_lazyloading = $value;
        SV_LazyImageLoader_Helper::$lazy_loader_icon = null;
        SV_LazyImageLoader_Helper::$lazy_loader_css = null;
        SV_LazyImageLoader_Helper::InstallTemplateHelper();
    }

    public static function IsLazyLoadEnabled()
    {
        if (SV_LazyImageLoader_Helper::$enable_lazyloading === null)
        {
            if (XenForo_Application::getOptions()->SV_LazyLoader_EnableDefault)
                SV_LazyImageLoader_Helper::$enable_lazyloading = true;
            else
                SV_LazyImageLoader_Helper::$enable_lazyloading = false;
            SV_LazyImageLoader_Helper::InstallTemplateHelper();
        }
        return SV_LazyImageLoader_Helper::$enable_lazyloading;
    }

    public static function _getLoaderIcon()
    {
        if (SV_LazyImageLoader_Helper::$lazy_loader_icon === null)
        {
            if (SV_LazyImageLoader_Helper::IsLazyLoadEnabled())
            {
                $options = XenForo_Application::getOptions();
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
                SV_LazyImageLoader_Helper::$WasLazyLoadUsed = true;
            }
            else
            {
                SV_LazyImageLoader_Helper::$lazy_loader_icon = false;
            }
        }
        return SV_LazyImageLoader_Helper::$lazy_loader_icon;
    }

    public static function _getLoaderCss()
    {
        if (SV_LazyImageLoader_Helper::$lazy_loader_css === null)
        {
            SV_LazyImageLoader_Helper::$lazy_loader_css = false;
            if (SV_LazyImageLoader_Helper::IsLazyLoadEnabled())
            {
                $options = XenForo_Application::getOptions();

                $spinnerCSS = $options->SV_LazyLoader_Spinner_CSS;
                if (!empty($spinnerCSS))
                {
                    SV_LazyImageLoader_Helper::$lazy_loader_css = $spinnerCSS;
                }

                SV_LazyImageLoader_Helper::$WasLazyLoadUsed = true;
            }
        }
        return SV_LazyImageLoader_Helper::$lazy_loader_css;
    }
}