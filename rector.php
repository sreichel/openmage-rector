<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector as CodeQuality;
use Rector\CodingStyle\Rector as CodingStyle;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector as DeadCode;
use Rector\Naming\Rector as Naming;
use Rector\Php53\Rector as Php53;
use Rector\Php54\Rector as Php54;
use Rector\Php71\Rector as Php71;
use Rector\Php80\Rector as Php80;
use Rector\Php81\Rector as Php81;
use Rector\Renaming\Rector as Renaming;
use Rector\Set\ValueObject\SetList;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Strict\Rector as Strict;
use Rector\Transform\Rector as Transform;
use Rector\TypeDeclaration\Rector as TypeDeclaration;
use Rector\Visibility\Rector as Visibility;

return static function (RectorConfig $rectorConfig): void
{
    $rectorConfig->paths([
        __DIR__ . '/app',
        __DIR__ . '/dev',
        __DIR__ . '/errors',
        __DIR__ . '/js',
        __DIR__ . '/lib',
        __DIR__ . '/shell',
    ]);

    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_81,
        SetList::DEAD_CODE,
        SetList::CODING_STYLE,
        SetList::CODE_QUALITY,
//        SetList::NAMING,
//        SetList::TYPE_DECLARATION,
    ]);

    $rules = [
        /**
         * CUse ?: instead of ?, where useful
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#ternarytoelvisrector
         */
        Php53\Ternary\TernaryToElvisRector::class => true,

        /**
         * Long array to short array
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#longarraytoshortarrayrector
         */
        Php54\Array_\LongArrayToShortArrayRector::class => true,

        /**
         * Changes multi catch of same exception to single one | separated.
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#multiexceptioncatchrector
         */
        Php71\TryCatch\MultiExceptionCatchRector::class => true,

        /**
         * Remove unused variable in catch()
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#removeunusedvariableincatchrector
         */
        Php80\Catch_\RemoveUnusedVariableInCatchRector::class => false,

        /**
         * Change mixed docs type to mixed typed
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#mixedtyperector
         */
        Php80\FunctionLike\MixedTypeRector::class => false,

        /**
         * Add final to constants that does not have children
         *
         * do not make constants final
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#finalizepublicclassconstantrector
         */
        Php81\ClassConst\FinalizePublicClassConstantRector::class => false,

        /**
         * Change null to strict string defined function call args
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#nulltostrictstringfunccallargrector
         */
        Php81\FuncCall\NullToStrictStringFuncCallArgRector::class => true,

        /**
         * Convert [$this, "method"] to proper anonymous function
         * @todo coming
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#callablethisarraytoanonymousfunctionrector
         */
        CodeQuality\Array_\CallableThisArrayToAnonymousFunctionRector::class => false,

        /**
         * When throwing into a catch block, checks that the previous exception is passed to the new throw clause
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#throwwithpreviousexceptionrector
         */
        CodeQuality\Catch_\ThrowWithPreviousExceptionRector::class => true,

        /**
         * Add missing dynamic properties
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#completedynamicpropertiesrector
         */
        CodeQuality\Class_\CompleteDynamicPropertiesRector::class => false,

        /**
         * Joins concat of 2 strings, unless the length is too long
         * @todo too much changes
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#joinstringconcatrector
         */
        CodeQuality\Concat\JoinStringConcatRector::class => false,

        /**
         * Removes useless variable assigns
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#simplifyuselessvariablerector
         */
        CodeQuality\FunctionLike\SimplifyUselessVariableRector::class => true,

        /**
         * Merges nested if statements
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#combineifrector
         */
        CodeQuality\If_\CombineIfRector::class => true,

        /**
         * Make if conditions more explicit
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#explicitboolcomparerector
         */
        CodeQuality\If_\ExplicitBoolCompareRector::class => false,

        /**
         * Changes if/else for same value as assign to ternary
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#simplifyifelsetoternaryrector
         */
        CodeQuality\If_\SimplifyIfElseToTernaryRector::class => true,

        /**
         * Shortens else/if to elseif
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#shortenelseifrector
         */
        CodeQuality\If_\ShortenElseIfRector::class => true,

        /**
         * Shortens if return false/true to direct return
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#simplifyifreturnboolrector
         */
        CodeQuality\If_\SimplifyIfReturnBoolRector::class => true,

        /**
         * Simplify regex pattern to known ranges
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#simplifyregexpatternrector
         */
        CodeQuality\FuncCall\SimplifyRegexPatternRector::class => true,

        /**
         * Switch negated ternary condition rector
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#switchnegatedternaryrector
         */
        CodeQuality\Ternary\SwitchNegatedTernaryRector::class => true,

        /**
         * Type and name of catch exception should match
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#catchexceptionnamematchingtyperector
         */
        CodingStyle\Catch_\CatchExceptionNameMatchingTypeRector::class => false,

        /**
         * Convert enscaped {$string} to more readable sprintf or concat, if no mask is used
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#encapsedstringstosprintfrector
         * @todo later
         */
        CodingStyle\Encapsed\EncapsedStringsToSprintfRector::class => false,

        /**
         * Wrap encapsed variables in curly braces
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#wrapencapsedvariableincurlybracesrector
         */
        CodingStyle\Encapsed\WrapEncapsedVariableInCurlyBracesRector::class => false,

        /**
         * Change count array comparison to empty array comparison to improve performance
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#countarraytoemptyarraycomparisonrector
         */
        CodingStyle\FuncCall\CountArrayToEmptyArrayComparisonRector::class => true,

        /**
         * Add new line after statements to tidify code
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#newlineafterstatementrector
         */
        CodingStyle\Stmt\NewlineAfterStatementRector::class => true,

        /**
         * Remove if condition that is always true
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#removealwaystrueifconditionrector
         */
        DeadCode\If_\RemoveAlwaysTrueIfConditionRector::class => false,

        /**
         * Remove and true that has no added value
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#removeandtruerector
         */
        DeadCode\BooleanAnd\RemoveAndTrueRector::class => true,

        /**
         * Remove @param docblock with same type as parameter type
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#removeuselessparamtagrector
         */
        DeadCode\ClassMethod\RemoveUselessParamTagRector::class => false,

        /**
         * Remove initialization with null value from property declarations
         *
         * keep public $_property = null
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#removenullpropertyinitializationrector
         */
        DeadCode\PropertyProperty\RemoveNullPropertyInitializationRector::class => false,

        /**
         * Remove unused parent call with no parent class
         *
         * keep parent::__construct()
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#removeparentcallwithoutparentrector
         */
        DeadCode\StaticCall\RemoveParentCallWithoutParentRector::class => false,

        /**
         * Rename property and method param to match its type
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#renamepropertytomatchtyperector
         * @todo enable
         */
        Naming\Class_\RenamePropertyToMatchTypeRector::class => false,

        /**
         * Fixer for PHPStan reports by strict type rule - "PHPStan\Rules\DisallowedConstructs\DisallowedEmptyRule"
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#disallowedemptyrulefixerrector
         */
        Strict\Empty_\DisallowedEmptyRuleFixerRector::class => false,

        /**
         * Add #[\ReturnTypeWillChange] attribute to configured instanceof class with methods
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#returntypewillchangerector
         */
        Transform\ClassMethod\ReturnTypeWillChangeRector::class => true,

        /**
         * Add property type based on strict setter and getter method
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#propertytypefromstrictsettergetterrector
         */
        TypeDeclaration\Class_\PropertyTypeFromStrictSetterGetterRector::class => true,

        /**
         * Add missing return type declaration based on parent class method
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#addreturntypedeclarationbasedonparentclassmethodrector
         */
        TypeDeclaration\ClassMethod\AddReturnTypeDeclarationBasedOnParentClassMethodRector::class => true,

        /**
         * Change param type based on parent param type
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#paramtypebyparentcalltyperector
         */
        TypeDeclaration\ClassMethod\ParamTypeByParentCallTypeRector::class => true,

        /**
         * Add "never" return-type for methods that never return anything
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#returnnevertyperector
         */
        TypeDeclaration\ClassMethod\ReturnNeverTypeRector::class => true,

        /**
         * Add return type from return direct array
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#returntypefromreturndirectarrayrector
         */
        TypeDeclaration\ClassMethod\ReturnTypeFromReturnDirectArrayRector::class => true,

        /**
         * Add strict return type based on returned strict expr type
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#returntypefromstrictboolreturnexprrector
         */
        TypeDeclaration\ClassMethod\ReturnTypeFromStrictBoolReturnExprRector::class => true,

        /**
         * Add strict type declaration based on returned constants
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#returntypefromstrictconstantreturnrector
         */
        TypeDeclaration\ClassMethod\ReturnTypeFromStrictConstantReturnRector::class => true,

        /**
         * Add return type from strict return $this
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#returntypefromstrictfluentreturnrector
         */
        TypeDeclaration\ClassMethod\ReturnTypeFromStrictFluentReturnRector::class => false,

        /**
         * Add declare(strict_types=1) if missing
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#declarestricttypesrector
         */
        TypeDeclaration\StmtsAwareInterface\DeclareStrictTypesRector::class => false,

        /**
         * Add explicit public method visibility
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#explicitpublicclassmethodrector
         */
        Visibility\ClassMethod\ExplicitPublicClassMethodRector::class => true,
    ];

    $run = array_filter($rules);
    $skip = array_diff($rules, $run);

    $rectorConfig->rules(array_keys($run));
    $rectorConfig->skip(array_keys($skip));

//    $rectorConfig->skip([
//        # see https://github.com/rectorphp/rector/issues/7699
//        CodeQuality\FuncCall\ArrayKeysAndInArrayToArrayKeyExistsRector::class => [
//            __DIR__ . '/app/code/core/Mage/Catalog/Model/Resource/Product/Collection.php',
//        ],
//    ]);
};
