<?php

namespace My\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

final class ProductValidator extends ValidationException
{
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Validation message if Something fails validation.',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'Validation message if the negative of Something is called and fails validation.',
        ],
    ];
}