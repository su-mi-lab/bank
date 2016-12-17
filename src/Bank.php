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
     * @var array
     */
    private static $schema = [];

    /**
     * @param array $config
     */
    public static function setConfig(array $config)
    {
        static::$config = $config;
    }

    /**
     * @param string $adapterNamespace
     * @return AdapterInterface
     * @throws \Exception
     */
    public static function adapter($adapterNamespace = self::ADAPTER_DEFAULT_NAMESPACE): AdapterInterface
    {
        if (!isset(static::$config['adapter'][$adapterNamespace])) {
            throw new \Exception('not found adapter Query.config');
        }

        if (isset(static::$adapter[$adapterNamespace])) {
            return static::$adapter[$adapterNamespace];
        }

        $config = static::$config['adapter'][$adapterNamespace];

        $dns = $config['dns'] ?? null;
        $user = $config['user'] ?? null;
        $password = $config['password'] ?? null;

        if (is_null($dns) || is_null($user) || is_null($password)) {
            throw new \Exception('Parameter is invalid');
        }

        static::$adapter[$adapterNamespace] = new Adapter($dns, $user, $password);

        return static::$adapter[$adapterNamespace];
    }

    /**
     * @param $schemaName
     * @return mixed
     * @throws \Exception
     */
    public static function schema($schemaName)
    {
        if (!isset(static::$config['schema'])) {
            throw new \Exception('not found schema dir');
        }

        if (isset(static::$schema[$schemaName])) {
            return static::$schema[$schemaName];
        }

        $schemaDir = static::$config['schema'];
        static::$schema[$schemaName] = include ($schemaDir . $schemaName);

        return static::$schema[$schemaName];
    }
}