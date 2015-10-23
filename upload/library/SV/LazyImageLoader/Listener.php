<?php

class SV_LazyImageLoader_Listener
{
    const AddonNameSpace = 'SV_LazyImageLoader_';

    public static function load_class($class, array &$extend)
    {
        $extend[] = self::AddonNameSpace.$class;
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