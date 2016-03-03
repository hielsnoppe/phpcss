<?php

/**
 * class NielsHoppe\PHPCSS\Configuration
 */

namespace NielsHoppe\PHPCSS;

/**
 * Library for utility functions
 */

class Configuration {

    /**
     * @var mixed[] $settings  An array of configuration keys and values
     */

    private static $settings = array(

        'require_compatible_2_1' => false
    );

    /**
     * Return a configuration key
     *
     * @param string $key
     * @return mixed
     */

    public static function get ($key) {

        if (array_key_exists($key, self::$settings)) {

            return self::$settings[$key];
        }

        return null;
    }

    /**
     * Set a configuration key to a given value
     *
     * @param string $key
     * @param mixed $value
     */

    public static function set ($key, $value) {

        if (array_key_exists($key, self::$settings)) {

            self::$settings[$key] = $value;

            return true;
        }

        return false;
    }
}
