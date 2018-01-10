<?php

class SV_LazyImageLoader_Listener
{
    public static function load_class($class, array &$extend)
    {
        $extend[] = 'SV_LazyImageLoader_' . $class;
    }

    public static function template_create(&$templateName, array &$params, XenForo_Template_Abstract $template)
    {
        switch ($templateName)
        {
            case 'forum_list_recent_attachments':
                SV_LazyImageLoader_Helper::SetLazyLoadEnabled(true);
                break;
        }
    }
}
