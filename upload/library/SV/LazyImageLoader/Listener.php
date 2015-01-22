<?php

class SV_LazyImageLoader_Listener
{
    const AddonNameSpace = 'SV_LazyImageLoader';

	public static function load_class($class, array &$extend)
	{
        switch($class)
        {
            case 'XenForo_BbCode_Formatter_Base':
                $extend[] = self::AddonNameSpace.'_'.$class;
                break;
        }
	}
}