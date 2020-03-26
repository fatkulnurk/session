<?php

namespace Fatkulnurk\Session;

class Session
{

    private static $sessionStarted = false;

    public static function init($lifeTimeInSeconds = 0)
    {
        if (self::$sessionStarted == false) {
            session_set_cookie_params($lifeTimeInSeconds);
            session_start();

            return (self::$sessionStarted = true);
        }

        return false;
    }

    public static function set($key, $value = false)
    {
        if (is_array($key) && $value == false) {
            foreach ($key as $name => $keyValue) {
                $_SESSION[$name] = $keyValue;
            }
        } else {
            $_SESSION[$key] = $value;
        }

        return true;
    }

    /*
     * Ambil nilai session, lalu unset, lalu kembalikan nilainya.
     * */
    public static function pull($key)
    {
        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];
            unset($_SESSION[$key]);

            return $value;
        }

        return null;
    }

    public static function get($key = '', $secondkey = false)
    {
        // menambahkan dotkey, agar bisa akses nested.

        $name = $key;

        if (empty($key)) {
            return isset($_SESSION) ? $_SESSION : null;
        } elseif ($secondkey == true) {
            if (isset($_SESSION[$name][$secondkey])) {
                return $_SESSION[$name][$secondkey];
            }
        }

        return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
    }

    /*
     * Mendapatkan session id
     * */
    public static function id()
    {
        return session_id();
    }

    public static function regenerate()
    {
        session_regenerate_id(true);

        return session_id();
    }

    public static function destroy($key = '')
    {
        if (self::$sessionStarted == true) {
            if ($key == '') {
                session_unset();
                session_destroy();
            } else {
                unset($_SESSION[$key]);
            }

            return true;
        }

        return false;
    }
}