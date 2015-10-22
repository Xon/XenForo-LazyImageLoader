<?php

class SV_LazyImageLoader_XenForo_BbCode_Formatter_Base  extends XFCP_SV_LazyImageLoader_XenForo_BbCode_Formatter_Base
{
    static $lazy_imageTemplate = null;
    static $lazy_tagImageTemplate = null;
    static $forceSpoilerTags = null;

    public function __construct()
    {
        parent::__construct();
        if (self::$lazy_imageTemplate === null)
        {
            self::$lazy_imageTemplate = $this->getLoaderTemplate();
        }
        if (self::$lazy_imageTemplate)
        {
            $this->_imageTemplate = self::$lazy_imageTemplate;
        }

        if (self::$forceSpoilerTags === null)
        {
            self::$forceSpoilerTags = XenForo_Application::getOptions()->sv_forceLazySpoilerTag;
            if (self::$forceSpoilerTags)
            {
                if (!self::$lazy_imageTemplate)
                {
                    SV_LazyImageLoader_Helper::SetLazyLoadEnabled(true);
                    self::$lazy_tagImageTemplate = $this->getLoaderTemplate();
                    SV_LazyImageLoader_Helper::SetLazyLoadEnabled(false);
                }
                else
                {
                    self::$forceSpoilerTags = false;
                }
            }
        }
    }

    protected function getLoaderTemplate()
    {
        $url = SV_LazyImageLoader_Helper::_getLoaderIcon();
        if ($url)
        {
            return '<img src="'.$url.'" data-src="%1$s" class="bbCodeImage%2$s" alt="[&#x200B;IMG]" data-url="%3$s" style="display:none" /><noscript><img src="%1$s" /></noscript>';
        }
        else
        {
            return false;
        }
    }

    public function renderTagSpoiler(array $tag, array $rendererStates)
    {
        if (self::$forceSpoilerTags)
        {
            $temp = $this->_imageTemplate;
            $this->_imageTemplate = self::$lazy_tagImageTemplate;
        }

        $response = parent::renderTagSpoiler($tag, $rendererStates);

        if (self::$forceSpoilerTags)
        {
            $this->_imageTemplate = $temp;
        }
        return $response;
    }
}