<?php

class SV_LazyImageLoader_Helper
{
    public static function getLazySpinnerCss($content, $params, XenForo_Template_Abstract $template)
    {
        if (SV_LazyImageLoader_Helper::$enable_lazyloading)
        {
            $css = 'lazyload';
            if (!empty($params['attachment']))
            {
                $attachment = $params['attachment'];
                if (!empty($params['full']) && !empty($attachment['width']) && !empty($attachment['height']))
                {
                    $css .= '" width="'.$attachment['width'].'" height="'.$attachment['height'];
                }
                else if (!empty($attachment['thumbnail_width']) && !empty($attachment['thumbnail_height']))
                {
                    $css .='" width="'.$attachment['thumbnail_width'].'" height="'.$attachment['thumbnail_height'];
                }
            }
            return $css;
        }

        return '';
    }

    public static function getLazySpinnerUrl($content, $params, XenForo_Template_Abstract $template)
    {
        if (SV_LazyImageLoader_Helper::$enable_lazyloading)
        {
            return  $url . '" data-src="' . $params;
        }

        return $params;
    }

    static $enable_lazyloading = null;

    public static function SetLazyLoadEnabled($value)
    {
        SV_LazyImageLoader_Helper::$enable_lazyloading = $value;
    }

    public static function IsLazyLoadEnabled()
    {
        if (SV_LazyImageLoader_Helper::$enable_lazyloading === null)
        {
            if (XenForo_Application::getOptions()->SV_LazyLoader_EnableDefault)
                SV_LazyImageLoader_Helper::$enable_lazyloading = true;
            else
                SV_LazyImageLoader_Helper::$enable_lazyloading = false;
        }
        return SV_LazyImageLoader_Helper::$enable_lazyloading;
    }
}