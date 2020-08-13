<?php

use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

if (!function_exists('uuid_v4')) {
    /**
     * @return \Ramsey\Uuid\UuidInterface
     */
    function uuid_v4()
    {
        return \Illuminate\Support\Str::uuid();
    }
}

if (!function_exists('domain_path')) {
    /**
     * @param      $class
     * @param null $append
     *
     * @return false|string
     */
    function domain_path($class, $append = null)
    {
        $reflection = $class;
        try {
            $reflection = new ReflectionClass($class);
        }
        catch (\ReflectionException $e) {
        }
        $realPath = realpath(dirname($reflection->getFileName()) . '/../');
        if (!$append) return $realPath;
        return $realPath . '/' . $append;
    }
}

if (!function_exists('add_date')) {
    /**
     * @param string $type
     * @param int    $value
     *
     * @param Carbon $date
     *
     * @return string
     */
    function add_date(string $type, int $value, Carbon $date = null)
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

if (!function_exists('j_date_format')) {
    /**
     * @param Carbon $date
     *
     * @return string
     */
    function j_date_format(Carbon $date = null)
    {
        return $date ? Verta::instance($date)->format('H:i  Y/n/d') : null;
    }
}


if (!function_exists('shop_route_path')) {
    /**
     * @param string $file
     *
     * @return string
     */
    function shop_route_path(string $file)
    {
        return base_path('routes/shop/modules/' . $file . '.php');
    }
}


if (!function_exists('dashboard_route_path')) {
    /**
     * @param string $file
     *
     * @return string
     */
    function dashboard_route_path(string $file)
    {
        return base_path('routes/dashboard/modules/' . $file . '.php');
    }
}


if (!function_exists('shop_route_path')) {
    /**
     * @param string $file
     *
     * @return string
     */
    function shop_route_path(string $file)
    {
        return base_path('routes/shop/modules/' . $file . '.php');
    }
}

if (!function_exists('sha1_pro')) {
    /**
     * @return string
     */
    function sha1_pro()
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

if (!function_exists('str_is')) {
    /**
     * Determine if a given string matches a given pattern.
     *
     * @param string|array $pattern
     * @param string       $value
     *
     * @return bool
     */
    function str_is($pattern, $value)
    {
        return Str::is($pattern, $value);
    }
}

if (!function_exists('fa_num')) {
    /**
     * @param $num
     *
     * @return string
     */
    function fa_num($num)
    {
        return str_replace(
            range(0, 9),
            ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'],
            $num);
    }
}

if (!function_exists('fa_slug')) {
    /**
     * Get the fa slug string
     *
     * @param string $title
     * @param string $separator
     *
     * @return string
     */
    function fa_slug($title, $separator = '-')
    {
        // Convert all dashes/underscores into separator
        $flip = $separator === '-' ? '_' : '-';

        $title = preg_replace('![' . preg_quote($flip) . ']+!u', $separator, trim($title));

        // Remove all characters that are not the separator, letters, numbers, or whitespace.
        $title = preg_replace('![^' . preg_quote($separator) . '\pL\pN\s]+!u', '', mb_strtolower($title, 'UTF-8'));

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

if (!function_exists('array_wrap_with')) {
    /**
     * change byte to human
     *
     * @param        $value
     * @param string $wrap
     *
     * @return array
     */
    function array_wrap_with($value, $wrap = 'data')
    {

        if (is_null($value)) {
            return compact($wrap);
        }

        return is_array($value) ? [$wrap => $value] : [$wrap => [$value]];
    }
}

if (!function_exists('array_unwrap')) {
    /**
     * un wrap the array
     *
     * @param mixed $value
     * @param int   $index
     *
     * @return mixed
     */
    function array_unwrap($value, $index = 0)
    {
        return is_array($value)
            ? $value[$index] : $value;
    }
}

if (!function_exists('order_number')) {

    function order_number()
    {
        $date   = Carbon::now();
        $month  = sprintf("%02d", $date->month);
        $day    = sprintf("%02d", $date->day);
        $hour   = sprintf("%02d", $date->hour);
        $second = sprintf("%02d", $date->second);
        return $date->year % 100 . $month . '-' . $day . $hour . '-' . $second . mt_rand(11, 99);
    }
}
