<?php

namespace App\Traits;

use ReflectionException;

trait EnhancedEnumTrait
{
    /**
     * Get the enum value from the name. e.g case INVOICE = 'invoice'; will return 'invoice'.
     *
     * @param  string  $name
     *
     * @throws ReflectionException
     *
     * @return static|null
     */
    public static function fromName(string $name): ?static
    {
        $reflection = new \ReflectionEnum(static::class);

        return $reflection->hasCase($name)
            ? $reflection->getCase($name)->getValue()
            : null;
    }

    /**
     * Get the enum names as an array.
     *
     * @return array
     */
    public static function toNames(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * Get the enum values as an array.
     *
     * @return array
     */
    public static function toValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get the enum as an array. e.g ['INVOICE' => 'invoice'] and reversible.
     *
     * @param  bool  $reverse
     * @return array
     */
    public static function toArray(bool $reverse = false): array
    {
        $result = array_combine(self::toNames(), self::toValues());

        return $reverse ? array_flip($result) : $result;
    }

    public static function toArrayWithReadableText(bool $reverse = false): array
    {
        $result = [];

        foreach (self::cases() as $enum) {
            $result[$enum->value] = $enum->readableText();
        }

        return $reverse ? array_flip($result) : $result;
    }
}
