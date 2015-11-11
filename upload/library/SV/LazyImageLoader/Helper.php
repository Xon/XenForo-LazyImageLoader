<?php

class SV_LazyImageLoader_Helper
{
    public static function getLazyLoadedImage($content, $params, XenForo_Template_Abstract $template)
    {
        $ratio = false;
        if (SV_LazyImageLoader_Helper::$enable_lazyloading)
        {
            if (!empty($params['attachment']))
            {
                $attachment = $params['attachment'];
                if (!empty($params['full']) && !empty($attachment['width']) && !empty($attachment['height']))
                {
                    $ratio = (100*$attachment['height']) / $attachment['width'];
                }
                else if (!empty($attachment['thumbnail_width']) && !empty($attachment['thumbnail_height']))
                {
                    $ratio = (100*$attachment['thumbnail_width']) / $attachment['thumbnail_height'];
                }
            }
        }
        $original = $params['1'] . $params['2'] . $params['3'] . $params['4'];

        if ($ratio)
        {
            return '<div class="ratio-container" style="padding-bottom:'.$ratio.'%">' .
                   $params['1'] . '"'. //'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" '.
                   ' data-src="' . $params['2'] . $params['3'] . ' lazyload ' .$params['4'] . '</div>' .
                   '<noscript>' . $original . '</noscript>';
        }

        return $original;
    }

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
                    $css .= '" style="max-width:'.$attachment['width'].'px;max-height:'.$attachment['height'] .'px ';
                }
                else if (!empty($attachment['thumbnail_width']) && !empty($attachment['thumbnail_height']))
                {
                    $css .='" style="max-width:'.$attachment['thumbnail_width'].'px;max-height:'.$attachment['thumbnail_height'] .'px ';
                }
            }
            return $css . @$params['extra'] . '<noscript>' . @$params['noscript'] . '</noscript>';
        }

        return @$params['extra'];
    }

    public static function getLazySpinnerUrl($content, $params, XenForo_Template_Abstract $template)
    {
        if (SV_LazyImageLoader_Helper::$enable_lazyloading)
        {
            return  '" data-src="' . $params;
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