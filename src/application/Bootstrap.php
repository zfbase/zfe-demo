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
            'host' => 'DB_HOST',
            'port' => 'DB_PORT',
            'schema' => 'DB_DATABASE',
            'username' => 'DB_USERNAME',
            'password' => 'DB_PASSWORD',
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

        var_dump($config);die;

        return $config;
    }
}
