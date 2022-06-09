<?php
/**
 * Conventions plugin for Craft CMS 4.x
 *
 * Craft Conventions
 *
 * @link      https://zaengle.com/
 * @copyright Copyright (c) 2022 Zaengle Corp
 */

namespace zaengle\conventions\models;

use craft\base\Model;

/**
 * @author    Zaengle Corp
 * @package   zaengle\conventions
 * @since     1.0.0
 */
class PatternType extends Model
{
    // Public Properties
    // =========================================================================
    public array $params;
    public array $resolver;
    public array $scaffold;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
      [
        ['resolver', 'scaffold'], 'required',
      ],
      [
        ['params', 'resolver', 'scaffold'], 'array',
      ],
      [
        'params', 'default', 'value' => [
          'ensure' => [],
          'reject' => [],
          'require' => [],
        ],
      ],
      ['resolver', 'validateResolverConfig'],
      // ['scaffold', 'validateScaffoldConfig'],
      // ['param', 'validateParamConfig'],
    ];
    }

    public function validateResolverConfig(string $attribute): bool
    {
        // dd('validate', $this->$attribute);
        // @todo
        return true;
    }

    public function getEnsuredContext(): array
    {
        return $this->params['ensure'];
    }

    public function getRequiredContextKeys(): array
    {
        return $this->params['require'];
    }
  
    public function getRejectedContextKeys(): array
    {
        return $this->params['reject'];
    }
}
