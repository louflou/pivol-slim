<?php

namespace DS;

if (!function_exists('\\DS\\includeFile')) {
    /**
     * Includes a file in a scope isolated function.
     *
     * @param string $fileToInclude - The filename that will be included.
     * @param array  $data          - Data that will be extracted into the file.
     */
    function includeFile($fileToInclude, array $data = [])
    {
        if (!is_readable($fileToInclude)) {
            throw new \RuntimeException(
                'Couldn\'t find the file or it is not readable. File: ' . $fileToInclude . '.'
            );
        }

        extract($data);
        include $fileToInclude;
    }
}
