<?php
namespace App\Infrastructure\Enums;

/**
 * Base Enum class
 *
 * Create an enum by implementing this class and adding class constants.
 */
abstract class Enum implements \JsonSerializable
{
    protected $value;
    protected static $cache = [];

    public function __construct($value)
    {
        if ($value instanceof static)
            $value = $value->getValue();
        if (!$this->isValid($value))
            throw new \UnexpectedValueException("Value '$value' is not part of the enum " . static::class);
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getKey()
    {
        return static::search($this->value);
    }

    public function __toString()
    {
        return (string)$this->value;
    }

    final public function equals($variable = null): bool
    {
        return $variable instanceof self
            && $this->getValue() === $variable->getValue()
            && static::class === \get_class($variable);
    }

    public static function keys()
    {
        return \array_keys(static::toArray());
    }

    public static function values()
    {
        $values = array();
        foreach (static::toArray() as $key => $value)
            $values[$key] = new static($value);
        return $values;
    }

    public static function toArray()
    {
        $class = static::class;
        if (!isset(static::$cache[$class])) {
            $reflection            = new \ReflectionClass($class);
            static::$cache[$class] = $reflection->getConstants();
        }
        return static::$cache[$class];
    }

    public static function isValid($value)
    {
        return \in_array($value, static::toArray(), true);
    }

    public static function isValidKey($key)
    {
        $array = static::toArray();
        return isset($array[$key]) || \array_key_exists($key, $array);
    }

    public static function search($value)
    {
        return \array_search($value, static::toArray(), true);
    }

    public static function __callStatic($name, $arguments)
    {
        $array = static::toArray();
        if (isset($array[$name]) || \array_key_exists($name, $array)) {
            return new static($array[$name]);
        }
        throw new \BadMethodCallException("No static method or enum constant '$name' in class " . static::class);
    }

    public function jsonSerialize()
    {
        return $this->getValue();
    }
}
