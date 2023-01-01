<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector as CodeQuality;
use Rector\CodingStyle\Rector as CodingStyle;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector as DeadCode;
use Rector\Php71\Rector as Php71;
use Rector\Renaming\Rector as Renaming;
use Rector\Set\ValueObject\SetList;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Transform\Rector as Transform;
use Rector\TypeDeclaration\Rector as TypeDeclaration;
use Rector\Visibility\Rector as Visibility;

return static function (RectorConfig $rectorConfig): void
{
    $rectorConfig->paths([
        __DIR__ . '/app',
        __DIR__ . '/dev',
        __DIR__ . '/errors',
        __DIR__ . '/includes',
        __DIR__ . '/js',
        __DIR__ . '/lib',
        __DIR__ . '/shell',
    ]);

    $rectorConfig->sets([
        SetList::CODE_QUALITY,
//        LevelSetList::UP_TO_PHP_73,
    ]);

    $rectorConfig->rules([
        DeadCode\BooleanAnd\RemoveAndTrueRector::class,
        Transform\ClassMethod\ReturnTypeWillChangeRector::class,
        TypeDeclaration\ClassMethod\ReturnNeverTypeRector::class,
        Visibility\ClassMethod\ExplicitPublicClassMethodRector::class,
    ]);

    $rectorConfig->skip([
        CodeQuality\Array_\CallableThisArrayToAnonymousFunctionRector::class,
        CodeQuality\Assign\CombinedAssignRector::class,
        CodeQuality\BooleanAnd\SimplifyEmptyArrayCheckRector::class,
        CodeQuality\Catch_\ThrowWithPreviousExceptionRector::class,
        CodeQuality\Class_\CompleteDynamicPropertiesRector::class,
        CodeQuality\Class_\InlineConstructorDefaultToPropertyRector::class,
        CodeQuality\ClassMethod\InlineArrayReturnAssignRector::class,
        CodeQuality\ClassMethod\OptionalParametersAfterRequiredRector::class,
        CodeQuality\ClassMethod\ReturnTypeFromStrictScalarReturnExprRector::class,
        CodeQuality\Concat\JoinStringConcatRector::class,
        CodeQuality\Expression\InlineIfToExplicitIfRector::class,
        CodeQuality\Expression\TernaryFalseExpressionToIfRector::class,
        CodeQuality\Do_\DoWhileBreakFalseToIfElseRector::class,
        CodeQuality\For_\ForToForeachRector::class,
        CodeQuality\Empty_\SimplifyEmptyCheckOnEmptyArrayRector::class,
        CodeQuality\Equal\UseIdenticalOverEqualWithSameTypeRector::class,
        CodeQuality\Foreach_\ForeachItemsAssignToEmptyArrayToAssignRector::class,
        CodeQuality\Foreach_\SimplifyForeachToArrayFilterRector::class,
        CodeQuality\Foreach_\SimplifyForeachToCoalescingRector::class,
        CodeQuality\FuncCall\SimplifyRegexPatternRector::class,
        CodeQuality\FuncCall\UnwrapSprintfOneArgumentRector::class,
        CodeQuality\FunctionLike\RemoveAlwaysTrueConditionSetInConstructorRector::class,
        CodeQuality\FunctionLike\SimplifyUselessLastVariableAssignRector::class,
        CodeQuality\FunctionLike\SimplifyUselessVariableRector::class,
        CodeQuality\Identical\FlipTypeControlToUseExclusiveTypeRector::class,
        CodeQuality\Identical\SimplifyBoolIdenticalTrueRector::class,
        CodeQuality\If_\CombineIfRector::class,
        CodeQuality\If_\ConsecutiveNullCompareReturnsToNullCoalesceQueueRector::class,
        CodeQuality\If_\ExplicitBoolCompareRector::class,
        CodeQuality\If_\RemoveAlwaysTrueIfConditionRector::class,
        CodeQuality\If_\ShortenElseIfRector::class,
        CodeQuality\If_\SimplifyIfElseToTernaryRector::class,
        CodeQuality\If_\SimplifyIfNullableReturnRector::class,
        CodeQuality\Include_\AbsolutizeRequireAndIncludePathRector::class,
        CodeQuality\Isset_\IssetOnPropertyObjectToPropertyExistsRector::class,
        CodeQuality\New_\NewStaticToNewSelfRector::class,
        CodeQuality\NotEqual\CommonNotEqualRector::class,
        CodeQuality\PropertyFetch\ExplicitMethodCallOverMagicGetSetRector::class,
        CodeQuality\Switch_\SingularSwitchToIfRector::class,
        CodingStyle\ClassMethod\FuncGetArgsToVariadicParamRector::class,
        CodingStyle\FuncCall\CountArrayToEmptyArrayComparisonRector::class,
        DeadCode\Cast\RecastingRemovalRector::class,
        Php71\FuncCall\RemoveExtraParametersRector::class,
        Renaming\FuncCall\RenameFunctionRector::class,
    ]);
};
