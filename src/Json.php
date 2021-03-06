<?php

namespace Bermuda\String;

/**
 * Class Json
 * @package Bermuda\String
 */
final class Json
{
    /**
     * @param $content
     * @param int $flags
     * @param int $depth
     * @return string
     * @throws \JsonException
     */
    public static function encode($content, int $flags = 0, int $depth = 512): string
    {
        if ($content instanceof Jsonable)
        {
            return $content->toJson($flags);
        }

        return json_encode($content, $flags | JSON_THROW_ON_ERROR, $depth);
    }

    /**
     * @param string $content
     * @param bool|null $assoc
     * @param int $depth
     * @param int $flags
     * @return mixed
     * @throws \JsonException
     */
    public static function decode(string $content, ?bool $assoc = false, int $depth = 512, int $flags = 0)
    {
        return json_decode($content, $assoc, $depth, $flags | JSON_THROW_ON_ERROR);
    }

    /**
     * @param $content
     * @return bool
     */
    public static function isJson($content): bool
    {
        if (!is_string($content))
        {
            return false;
        }

        try {
            json_decode($content, null, null, JSON_THROW_ON_ERROR);
            return true;
        }

        catch (\Throwable $e)
        {
            return false;
        }
    }
}
