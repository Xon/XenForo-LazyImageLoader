<?php

class SV_LazyImageLoader_XenForo_BbCode_Formatter_Base  extends XFCP_SV_LazyImageLoader_XenForo_BbCode_Formatter_Base
{
    static $lazy_imageTemplate = null;
    static $forceSpoilerTags = null;
    static $lazyLoading = null;

    public function __construct()
    {
        parent::__construct();

        self::$lazyLoading = SV_LazyImageLoader_Helper::IsLazyLoadEnabled();
        self::$forceSpoilerTags = !self::$lazyLoading && XenForo_Application::getOptions()->sv_forceLazySpoilerTag;
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

    public function renderTagImage(array $tag, array $rendererStates)
    {
        if (self::$lazy_imageTemplate === null && self::$lazyLoading)
        {
            self::$lazy_imageTemplate = $this->getLoaderTemplate();
            self::$lazyLoading = !empty(self::$lazy_imageTemplate);
            if (self::$lazyLoading)
            {
                $this->_imageTemplate = self::$lazy_imageTemplate;
            }
        }
        return parent::renderTagImage($tag, $rendererStates);
    }

    public function renderTagSpoiler(array $tag, array $rendererStates)
    {
        if (self::$forceSpoilerTags)
        {
            $temp = $this->_imageTemplate;
            if (empty(self::$lazy_imageTemplate))
            {
                SV_LazyImageLoader_Helper::SetLazyLoadEnabled(true);
                self::$lazy_imageTemplate = $this->getLoaderTemplate();
                SV_LazyImageLoader_Helper::SetLazyLoadEnabled(false);
                self::$forceSpoilerTags = !empty(self::$lazy_imageTemplate);
            }
            if (self::$forceSpoilerTags)
            {
                $this->_imageTemplate = self::$lazy_imageTemplate;
            }
        }

        $response = parent::renderTagSpoiler($tag, $rendererStates);

        if (self::$forceSpoilerTags)
        {
            $this->_imageTemplate = $temp;
        }
        return $response;
    }
}