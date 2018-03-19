<?php

namespace DS;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

/**
 * Will manage the configuration and create Views.
 */
class ViewManager
{
    /**
     * @var self - The global manager
     */
    protected static $global;

    /**
     * @var array
     */
    protected $config;


    /**
     * ViewManager constructor.
     *
     * @param array $config
     */
    public function __construct($config = [])
    {
        $default = [
            'directory' => '',
            'prefix' => 'phtml',
        ];

        $config = array_merge($default, $config);
        $this->configure($config);
    }


    /**
     * Update the current configuration.
     *
     * @param $config
     *
     * @return self
     */
    public function configure($config)
    {
        $config = Arr::only($config, ['directory', 'prefix']);
        $config['prefix'] = '.' . $config['prefix'];

        $this->config = $config;

        return $this;
    }


    /**
     * Creates a View with the configured settings.
     *
     * @param string          $file - The file to render. Can use dots instead of slashes.
     * @param array|Arrayable $data - The data that will be passed in.
     *
     * @return View
     */
    public function make($file, $data = [])
    {
        $file = str_replace('.', DIRECTORY_SEPARATOR, $file);
        $file = $this->config['directory'] . DIRECTORY_SEPARATOR . $file . $this->config['prefix'];

        return new View($file, $data);
    }


    /**
     * Sets this manager as global
     *
     * @return self
     */
    public function setAsGlobal()
    {
        self::$global = $this;

        return $this;
    }


    /**
     * Will return the global manager.
     *
     * @return self
     */
    public static function getGlobal()
    {
        if (self::$global === null) {
            throw new \RuntimeException(
                'You have to set a ViewManager as global before retrieving a global manager.'
            );
        }

        return self::$global;
    }
}
