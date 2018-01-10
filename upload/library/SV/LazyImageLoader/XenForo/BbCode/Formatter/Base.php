<?php

class SV_LazyImageLoader_XenForo_BbCode_Formatter_Base  extends XFCP_SV_LazyImageLoader_XenForo_BbCode_Formatter_Base
{
    /** @var string */
    static $lazy_imageTemplate = '<img data-src="%1$s" class="bbCodeImage%2$s lazyload" alt="[&#x200B;IMG]" data-url="%3$s" /><noscript><img src="%1$s" alt="[&#x200B;IMG]"></noscript>';
    /** @var bool|null */
    static $forceSpoilerTags   = null;
    /** @var bool|null */
    static $lazyLoading        = null;

    public function __construct()
    {
        parent::__construct();

        self::$lazyLoading = SV_LazyImageLoader_Helper::IsLazyLoadEnabled();
        self::$forceSpoilerTags = !self::$lazyLoading && XenForo_Application::getOptions()->sv_forceLazySpoilerTag;
    }

    public function renderTagImage(array $tag, array $rendererStates)
    {
        if (self::$lazyLoading)
        {
            $this->_imageTemplate = self::$lazy_imageTemplate;
        }

        return parent::renderTagImage($tag, $rendererStates);
    }

    public function renderTagSpoiler(array $tag, array $rendererStates)
    {
        if (self::$forceSpoilerTags)
        {
            $temp = $this->_imageTemplate;
            SV_LazyImageLoader_Helper::SetLazyLoadEnabled(true);
            $this->_imageTemplate = self::$lazy_imageTemplate;
        }

        $response = parent::renderTagSpoiler($tag, $rendererStates);

        if (self::$forceSpoilerTags)
        {
            $this->_imageTemplate = $temp;
            SV_LazyImageLoader_Helper::SetLazyLoadEnabled(false);
        }

        return $response;
    }
}
