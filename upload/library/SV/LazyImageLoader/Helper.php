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
                    $css .= '" style="max-height:'.$attachment['height'] .'px ';
                }
                else if (!empty($attachment['thumbnail_width']) && !empty($attachment['thumbnail_height']))
                {
                    $css .='" style="max-height:'.$attachment['thumbnail_height'] .'px ';
                }
            }
            return $css . @$params['extra'] . '<noscript>' . @$params['noscript'] . '</noscript>';
        }

        return @$params['extra'];
    }

    public static function getLazySpinnerUrl($content, $params, XenForo_Template_Abstract $template)
    {
        $originalUrl = is_array($params) ? $params['url'] : $params;
        if (SV_LazyImageLoader_Helper::$enable_lazyloading)
        {
            $placeholder = '';
            if (is_array($params))
            {
                $width = $params['width'];
                $height = $params['height'];
                $placeholder = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 {$width} {$height}'%2F%3E";
            }
            // Insert an SVG with proper aspect ratio to make responsive design work smoothly
            return $placeholder . '" data-src="' . $originalUrl;
        }

        return $originalUrl;
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