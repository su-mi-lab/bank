<?php

namespace Bank;

use Bank\DataStore\Adapter;
use Bank\DataStore\AdapterInterface;

/**
 * Class Bank
 * @package Bank
 */
class Bank
{
    const ADAPTER_DEFAULT_NAMESPACE = 'default';

    /**
     * @var array
     */
    private static $config = [];

    /**
     * @var array
     */
    private static $adapter = [];

    /**
     * @param array $config
     */
    public static function setConfig(array $config)
    {
        self::$config = $config;
    }

    /**
     * @param string $adapterNamespace
     * @return AdapterInterface
     * @throws \Exception
     */
    public static function adapter($adapterNamespace = self::ADAPTER_DEFAULT_NAMESPACE): AdapterInterface
    {
        if (!isset(self::$config[$adapterNamespace])) {
            throw new \Exception('not found adapter Query.config');
        }

        if (isset(self::$adapter[$adapterNamespace])) {
            return self::$adapter[$adapterNamespace];
        }

        $config = self::$config[$adapterNamespace];

        $dns = $config['dns'] ?? null;
        $user = $config['user'] ?? null;
        $password = $config['password'] ?? null;

        if (is_null($dns) || is_null($user) || is_null($password)) {
            throw new \Exception('Parameter is invalid');
        }

        self::$adapter[$adapterNamespace] = new Adapter($dns, $user, $password);

        return self::$adapter[$adapterNamespace];
    }
}