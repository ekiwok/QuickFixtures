<?php

namespace Ekiwok\QuickFixtures\Model;

final class Primitives
{
    const ARRAY_ = 'array';
    const BOOLEAN = 'boolean';
    const BOOLEAN_SHORT = 'bool';
    const CALLABLE_ = 'callable';
    const DOUBLE = 'double';
    const FLOAT = 'float';
    const INTEGER = 'integer';
    const INTEGER_SHORT = 'int';
    const NULL = 'null';
    const RESOURCE = 'resource';
    const STRING = 'string';

    const SCALARS = [
        self::INTEGER,
        self::DOUBLE,
        self::STRING,
        self::BOOLEAN
    ];

    /*
     * All scalars these may appear in dockblock these are not treated as classes.
     */
    const DOCK_BLOCK_PRIMITIVES = [
        self::ARRAY_,
        self::BOOLEAN,
        self::BOOLEAN_SHORT,
        self::CALLABLE_,
        self::DOUBLE,
        self::FLOAT,
        self::INTEGER,
        self::INTEGER_SHORT,
        self::NULL,
        self::RESOURCE,
        self::STRING,
    ];

    const NORMALIZATIONS = [
        self::ARRAY_            => self::ARRAY_,
        self::BOOLEAN           => self::BOOLEAN,
        self::BOOLEAN_SHORT     => self::BOOLEAN,
        self::CALLABLE_         => self::CALLABLE_,
        self::DOUBLE            => self::DOUBLE,
        self::FLOAT             => self::DOUBLE,
        self::INTEGER           => self::INTEGER,
        self::INTEGER_SHORT     => self::INTEGER,
        self::NULL              => self::NULL,
        self::RESOURCE          => self::RESOURCE,
        self::STRING            => self::STRING,
    ];
}
