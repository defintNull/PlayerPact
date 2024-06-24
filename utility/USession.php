<?php

/**
 * Manage Session for the application
 *
 * Manage Session for the application creating session instance to configure,
 * start and load sessions
 *
 * @package Playerpact\Utility
 */
class USession
{
    private static $instance;

    /**
     * Constructor
     *
     * Constructor
     *
     */
    private function __construct()
    {

    }

    /**
     * Generate instance for Session
     *
     * Generate Session instance to use singleton path
     * 
     */
    static function getInstance(): USession
    {
        if (self::$instance == null) {
            self::$instance = new USession();
        }
        return self::$instance;
    }

    /**
     * Start the session
     *
     * Start the session setting default configuration for cookies
     *
     * @return void
     * 
     */
    public function start()
    {
        session_set_cookie_params(
            array(
                'lifetime' => 43200,
                'secure' => 1
            )
        );
        session_start();
    }

    /**
     * Close Session
     *
     * Colse Session
     *
     * @return void
     * 
     */
    public function end()
    {
        session_unset();
        session_destroy();
    }

    /**
     * Store data in session
     *
     * Store data in session using key and value
     *
     * @param string $key The key to store
     * @param $obj The object to store
     *
     * @return void
     * 
     */
    public function set(string $key, $obj)
    {
        $_SESSION[$key] = serialize($obj);
    }

    /**
     * Load data from session
     *
     * Load data from session using key
     *
     * @param string $key The key used to load the data
     *
     */
    public function load(string $key)
    {
        if (isset($_SESSION[$key])) {
            return unserialize($_SESSION[$key]);
        }
        return null;
    }

    /**
     * Check Session exsistence
     *
     * Check Session exsistence
     *
     */
    public function exists(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            return false;
        }
        return true;
    }
}
