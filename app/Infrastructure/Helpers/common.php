<?php

use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

if (!function_exists('uuidV4')) {
    /**
     * @return \Ramsey\Uuid\UuidInterface
     */
    function uuidV4()
    {
        return \Illuminate\Support\Str::uuid();
    }
}

if (!function_exists('domainPath')) {
    /**
     * @param      $class
     * @param null $append
     *
     * @return false|string
     */
    function domainPath($class, $append = null)
    {
        $reflection = $class;
        try {
            $reflection = new ReflectionClass($class);
        } catch (\ReflectionException $e) {
        }
        $realPath = realpath(dirname($reflection->getFileName()) . '/../');
        if (!$append) return $realPath;
        return $realPath . '/' . $append;
    }
}

if (!function_exists('addDate')) {
    /**
     * @param string $type
     * @param int $value
     *
     * @param Carbon|null $date
     *
     * @return string
     */
    function addDate(string $type, int $value, Carbon $date = null)
    {
        $date = $date ?? Carbon::now();
        $result = $date;
        switch ($type) {
            case 'second' :
                $result = $date->addSeconds($value);
                break;
            case 'minute' :
                $result = $date->addMinutes($value);
                break;
            case 'hour' :
                $result = $date->addHours($value);
                break;
            case 'day' :
                $result = $date->addDays($value);
                break;
            case 'week' :
                $result = $date->addWeekdays($value);
                break;
            case 'month' :
                $result = $date->addMonths($value);
                break;
        }

        return $result;
    }
}

if (!function_exists('jDateFormat')) {
    /**
     * @param Carbon|null $date
     *
     * @return string
     */
    function jDateFormat(Carbon $date = null)
    {
        return $date ? Verta::instance($date)->format('H:i  Y/n/d') : null;
    }
}

if (!function_exists('sha1Pro')) {
    /**
     * @return string
     */
    function sha1Pro()
    {
        return sha1(microtime() . mt_rand(10000, 99999));
    }
}


if (!function_exists('setFaLocate')) {
    /**
     * set locale language
     */
    function setFaLocate()
    {
        App::setLocale('fa');
        Carbon::setLocale('fa');
    }

}

if (!function_exists('strIs')) {
    /**
     * Determine if a given string matches a given pattern.
     *
     * @param string|array $pattern
     * @param string $value
     *
     * @return bool
     */
    function strIs($pattern, string $value)
    {
        return Str::is($pattern, $value);
    }
}

if (!function_exists('toFaNum')) {
    /**
     * @param $num
     *
     * @return string
     */
    function toFaNum($num)
    {
        return str_replace(
            range(0, 9),
            ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'],
            $num);
    }
}

if (!function_exists('toFaSlug')) {
    /**
     * Get the fa slug string
     *
     * @param string $title
     * @param string $separator
     *
     * @return string
     */
    function toFaSlug(string $title, string $separator = '-')
    {
        // Convert all dashes/underscores into separator
        $flip = $separator === '-' ? '_' : '-';

        $title = preg_replace('![' . preg_quote($flip) . ']+!u', $separator, trim($title));

        // Remove all characters that are not the separator, letters, numbers, or whitespace.
        $title = preg_replace(
            '![^' . preg_quote($separator) . '\pL\pN\s]+!u',
            '',
            mb_strtolower($title, 'UTF-8')
        );

        // Replace all separator characters and whitespace by a single separator
        $title = preg_replace('![' . preg_quote($separator) . '\s]+!u', $separator, $title);

        return trim($title, $separator);
    }
}

if (!function_exists('joinPath')) {
    /**
     * Join the given path with DIRECTORY_SEPARATOR
     *
     * @param array $paths
     *
     * @return string
     */
    function joinPath(...$paths)
    {
        return implode(DIRECTORY_SEPARATOR, $paths);
    }
}

if (!function_exists('scanDirectory')) {
    /**
     * scan dir wrapper
     *
     * @param $dir
     *
     * @return array
     */
    function scanDirectory($dir)
    {
        $exec = scandir($dir);

        return array_splice($exec, 2);
    }
}


if (!function_exists('byteForHumans')) {
    /**
     * change byte to human
     *
     * @param $bytes
     *
     * @return string
     */
    function byteForHumans($bytes)
    {
        for ($i = 0; ($bytes >= 1024 && $i < 5); $i++)
            $bytes /= 1024;

        return round($bytes, 2) . [' B', ' KB', ' MB', ' GB', ' TB', ' PB'][$i];
    }
}

if (!function_exists('arrayUnwrap')) {
    /**
     * un wrap the array
     *
     * @param mixed $value
     * @param int $index
     *
     * @return mixed
     */
    function arrayUnwrap($value, int $index = 0)
    {
        return is_array($value)
            ? $value[$index] : $value;
    }
}
