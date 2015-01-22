<?php

class SV_LazyImageLoader_Listener
{
    const AddonNameSpace = 'SV_LazyImageLoader';

    public static function load_class($class, array &$extend)
    {
        switch($class)
        {
            case 'XenForo_BbCode_Formatter_Base':
            case 'XenForo_ControllerPublic_Thread':
            case 'XenForo_ControllerPublic_Conversation':
                $extend[] = self::AddonNameSpace.'_'.$class;
                break;
        }
    }
}