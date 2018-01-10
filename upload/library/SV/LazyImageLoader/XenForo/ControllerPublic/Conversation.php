<?php

class SV_LazyImageLoader_XenForo_ControllerPublic_Conversation extends XFCP_SV_LazyImageLoader_XenForo_ControllerPublic_Conversation
{
    static $lazy_loading_init = false;

    public function actionView()
    {
        if (empty(self::$lazy_loading_init))
        {
            self::$lazy_loading_init = true;
            $visitor = XenForo_Visitor::GetInstance();
            SV_LazyImageLoader_Helper::SetLazyLoadEnabled($visitor->hasPermission('conversation', 'sv_lazyload_enable'));
        }

        return parent::actionView();
    }
}
