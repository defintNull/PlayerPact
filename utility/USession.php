<?php
class USession
{
    private static $instance;

    private function __construct()
    {

    }

    static function getInstance(): USession
    {
        if (self::$instance == null) {
            self::$instance = new USession();
        }
        return self::$instance;
    }

    public function start()
    {
        session_start();
    }

    public function end()
    {
        session_unset();
        session_destroy();
    }

    public function set(string $key, $obj)
    {
        $_SESSION[$key] = serialize($obj);
    }

    public function load(string $key)
    {
        if (isset($_SESSION[$key])) {
            return unserialize($_SESSION[$key]);
        }
        return null;
    }

    public function exists(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            return false;
        }
        return true;
    }
}
?>