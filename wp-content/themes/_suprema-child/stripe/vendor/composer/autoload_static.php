<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4c9a079b7b184fa6fec5551a1805c9bd
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4c9a079b7b184fa6fec5551a1805c9bd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4c9a079b7b184fa6fec5551a1805c9bd::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
