<?php

class SV_LazyImageLoader_Listener
{
    const AddonNameSpace = 'SV_LazyImageLoader_';

    public static function load_class($class, array &$extend)
    {
        $extend[] = self::AddonNameSpace.$class;
    }
}