<?php

/**
 * Bootstrap
 */
class Bootstrap extends ZFE_Bootstrap
{
    protected function getParamsFromEnvVars($map)
    {
        $vars = getenv();
        $config = [];
        foreach ($map as $key => $var) {
            if (isset($vars[$var])) {
                $config[$key] = $vars[$var];
            }
        }
        return $config;
    }

    protected function getDoctrineConfigFromEnvVars()
    {
        $doctrine = [
            'host' => 'MYSQL_HOST',
            'port' => 'MYSQL_PORT',
            'schema' => 'MYSQL_DATABASE',
            'username' => 'MYSQL_USERNAME',
            'password' => 'MYSQL_PASSWORD',
        ];
        $sphinx = [
            'host' => 'SPHINX_HOST',
            'port' => 'SPHINX_PORT',
        ];
        return new Zend_Config([
            'doctrine' => $this->getParamsFromEnvVars($doctrine),
            'sphinx' => [
                'conn' => $this->getParamsFromEnvVars($sphinx),
            ],
        ]);
    }

    protected function _getConfig()
    {
        $config = parent::_getConfig();

        $config->merge(
            $this->getDoctrineConfigFromEnvVars(),
            $config
        );

        return $config;
    }
}
