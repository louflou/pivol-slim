<?php

namespace DS;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Arr;
use Psr\Http\Message\ResponseInterface;

/**
 * Renders PHP files.
 */
class View implements Renderable
{
    /**
     * @var string - The file to render.
     */
    protected $file;

    /**
     * @var array - The data that will be passed in.
     */
    protected $data;


    /**
     * View constructor.
     *
     * @param string          $file - The file to render.
     * @param array|Arrayable $data - The data that will be passed in.
     */
    public function __construct($file, $data = [])
    {
        if (!is_string($file)) {
            throw new \InvalidArgumentException(
                'The first parameter must be a string.'
            );
        }

        if (!(is_array($data) || $data instanceof Arrayable)) {
            throw new \InvalidArgumentException(
                'The second parameter must be an array or instance of ' . Arrayable::class . '.'
            );
        }

        $this->file = $file;
        $this->data = $data instanceof Arrayable ? $data->toArray() : $data;
    }


    /**
     * This will load the view file and pass in the data into the file.
     * Then it will render and return the results as a string.
     *
     * @return string
     */
    public function render()
    {
        ob_start();

        try {
            includeFile($this->file, $this->data);
            $result = ob_get_contents();
        } finally {
            ob_end_clean();
        }

        return $result;
    }


    /**
     * Will render the view and write the results to a response body.
     *
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function renderInto(ResponseInterface $response)
    {
        $response->getBody()->write($this->render());

        return $response;
    }


    /**
     * Will call render().
     *
     * @return string
     */
    public function __toString()
    {
        try {
            return $this->render();
        } catch (\Throwable $e) {
            return $e->__toString();
        }
    }


    /**
     * Pushes the values to an item within the data. If both values are arrays then they will be merged.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return self
     */
    public function push($key, $value)
    {
        $data = Arr::get($this->data, $key);

        if ($value instanceof Arrayable) {
            $value = $value->toArray();
        }

        if (is_array($value) && is_array($data)) {
            $value = array_merge($data, $value);
        }

        Arr::set($this->data, $key, $value);

        return $this;
    }


    /**
     * Pushes the values to an item within the data. If both values are arrays then they will be merged.
     *
     * @param array|Arrayable $data
     *
     * @return View
     */
    public function with($data)
    {
        if ($data instanceof Arrayable) {
            $data = $data->toArray();
        }

        $this->data = array_merge($this->data, $data);

        return $this;
    }


    /**
     * Will call a global manger to create a View with the configured settings.
     *
     * @param string          $file - The file to render. Can use dots instead of slashes.
     * @param array|Arrayable $data - The data that will be passed in.
     *
     * @return View
     */
    public static function make($file, $data = [])
    {
        return ViewManager::getGlobal()->make($file, $data);
    }
}
