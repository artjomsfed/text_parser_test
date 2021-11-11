<?php
declare(strict_types=1);


namespace TextParser\Enum;


use MyCLabs\Enum\Enum;


/**
 * @method static self NON_REPEATING()
 * @method static self LEAST_REPEATING()
 * @method static self MOST_REPEATING()
 */
class Format extends Enum
{
    private const NON_REPEATING = 'non-repeating';
    private const LEAST_REPEATING = 'least-repeating';
    private const MOST_REPEATING = 'most-repeating';

    public function getName(): string
    {
        return match ($this->getValue()) {
            self::NON_REPEATING => 'non-repeating',
            self::MOST_REPEATING => 'most repeating',
            self::LEAST_REPEATING => 'least repeating',
        };
    }
}