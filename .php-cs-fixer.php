<?php declare(strict_types=1);
$_SERVER['PHP_CS_FIXER_IGNORE_ENV'] = 1;
require_once __DIR__ . '/vendor/autoload.php';

use Zvive\Fixer\SharedConfig;
use Zvive\Fixer\Rulesets\ZviveRuleset;
use Zvive\Fixer\Finders\LaravelProjectFinder;

$finder = LaravelProjectFinder::create(__DIR__)->notName('*.stub');
// 'DeclareAfterOpeningTagFixer'              => true,
$rules = [
    // '@PSR12'                 => true,
    'ordered_class_elements' => [
        'order' => [
            'use_trait',
            'case',
            'constant',
            'property',
            'construct',
            'destruct',
            'magic',
            'phpunit',
            'method_abstract',
            'method',
        ],
        'sort_algorithm' => 'none',
    ],
    'concat_space' => [
        'spacing' => 'one',
    ],
    'general_phpdoc_annotation_remove' => [],
    'phpdoc_to_comment'                => ['ignored_tags' => ['internal', 'var', 'mixin', 'todo', 'phpstan-ignore-next-line']],
    'comment_to_phpdoc'                => ['ignored_tags' => ['todo', 'phpstan']],
    'no_superfluous_phpdoc_tags'       => false,
    'ordered_imports'                  => [
        'sort_algorithm' => 'length',
    ],
    'use_arrow_functions'        => false,
    'native_function_invocation' => [
        'exclude' => ['beforeAll', 'afterAll', 'beforeEach', 'afterEach', 'it', 'test', 'uses', 'usesBeforeAll', 'usesBeforeEach', 'dd', 'dump', 'before', 'after', 'config', 'env', 'factory', 'artisan', 'cache', 'app_path', 'base_path', 'database_path'],
        'include' => ['@compiler_optimized'],
        'scope'   => 'namespaced',
        'strict'  => true,
    ],
    // 'no_extra_blank_lines' => [
    //     'tokens' => [
    //         'attribute',
    //         'curly_brace_block',
    //         'parenthesis_brace_block',
    //         'default',
    //         'square_brace_block',
    //         'extra',
    //         // 'use',
    //         // 'use_trait',
    //     ],
    // ],
    'blank_line_after_opening_tag' => true,
    'linebreak_after_opening_tag'  => true,
    'binary_operator_spaces'       => [
        'default'   => 'align_single_space_minimal',
        'operators' => [
            '=>' => 'align_single_space_minimal',
            // '->' => 'align_single_space_minimal',
            '=' => 'align_single_space_minimal',
            // '?'  => 'align_single_space_minimal',
            '??' => 'align_single_space_minimal',
            // '?:' => 'align_single_space_minimal',
        ],
    ],
    'return_type_declaration' => [
        'space_before' => 'none',
    ],
    'method_argument_space' => [
        'on_multiline' => 'ensure_fully_multiline',
    ],
    // 'PhpCsFixerCustomFixers/declare_after_opening_tag' => false,
    'class_definition' => [
        'multi_line_extends_each_single_line' => true,
        // 'single_item_single_line'             => true,
        // 'single_line'                         => true,
        // 'single_line_extends_each_single_line' => true,
    ],

    'class_attributes_separation' => [
        'elements' => [
            'const'        => 'one',
            'method'       => 'one',
            'property'     => 'one',
            'trait_import' => 'none',
            'case'         => 'none',
        ],
    ],
];

    return SharedConfig::create($finder, new ZviveRuleset($rules))
    ->setPhpExecutable('/usr/bin/php-legacy');
