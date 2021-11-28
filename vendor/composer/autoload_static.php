<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit674b72f0a59510f2e34b16b4cbf7bf35
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Spawn\\App\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Spawn\\App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit674b72f0a59510f2e34b16b4cbf7bf35::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit674b72f0a59510f2e34b16b4cbf7bf35::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit674b72f0a59510f2e34b16b4cbf7bf35::$classMap;

        }, null, ClassLoader::class);
    }
}
