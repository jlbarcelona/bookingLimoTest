<?php
namespace App\Services;

class JsonStorageService
{
    private static function path($file)
    {
        return storage_path("app/data/{$file}.json");
    }

    public static function all($file)
    {
        if (!file_exists(self::path($file))) {
            return [];
        }

        return json_decode(file_get_contents(self::path($file)), true) ?? [];
    }

    public static function save($file, $data)
    {
        file_put_contents(
            self::path($file),
            json_encode($data, JSON_PRETTY_PRINT)
        );
    }
}