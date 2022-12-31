<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\FuncCall\BoolvalToTypeCastRector;
use Rector\CodeQuality\Rector\FuncCall\ChangeArrayPushToArrayAssignRector;
use Rector\CodeQuality\Rector\FuncCall\FloatvalToTypeCastRector;
use Rector\CodeQuality\Rector\FuncCall\IntvalToTypeCastRector;
use Rector\CodeQuality\Rector\FuncCall\StrvalToTypeCastRector;
use Rector\CodeQuality\Rector\Identical\BooleanNotIdenticalToNotIdenticalRector;
use Rector\CodeQuality\Rector\If_\CombineIfRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Transform\Rector\ClassMethod\ReturnTypeWillChangeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnNeverTypeRector;
use Rector\Visibility\Rector\ClassMethod\ExplicitPublicClassMethodRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/app',
        __DIR__ . '/dev',
        __DIR__ . '/errors',
        __DIR__ . '/includes',
        __DIR__ . '/js',
        __DIR__ . '/lib',
        __DIR__ . '/shell',
    ]);

    $rectorConfig->rules([
        BoolvalToTypeCastRector::class,
        BooleanNotIdenticalToNotIdenticalRector::class,
        ChangeArrayPushToArrayAssignRector::class,
        CombineIfRector::class,
        ExplicitPublicClassMethodRector::class,
        FloatvalToTypeCastRector::class,
        IntvalToTypeCastRector::class,
        StrvalToTypeCastRector::class,
        ReturnNeverTypeRector::class,
        ReturnTypeWillChangeRector::class,
    ]);
};
