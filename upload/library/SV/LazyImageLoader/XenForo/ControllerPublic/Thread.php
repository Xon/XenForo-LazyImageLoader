<?php

class SV_LazyImageLoader_XenForo_ControllerPublic_Thread extends XFCP_SV_LazyImageLoader_XenForo_ControllerPublic_Thread
{
    static $lazy_loading_init = false;

    protected function _getDefaultViewParams(array $forum, array $thread, array $posts, $page = 1, array $viewParams = array())
    {
        if (empty(self::$lazy_loading_init))
        {
            self::$lazy_loading_init = true;
            $visitor = XenForo_Visitor::GetInstance();
            $permissions = $visitor->getNodePermissions($thread['node_id']);
            SV_LazyImageLoader_Helper::SetLazyLoadEnabled( $visitor->hasNodePermission($thread['node_id'], 'sv_lazyload_enable') );
        }
        return parent::_getDefaultViewParams($forum, $thread, $posts, $page, $viewParams);
    }
}