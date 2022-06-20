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
use craft\helpers\ArrayHelper;

/**
 * @author    Zaengle Corp
 * @package   zaengle\conventions
 * @since     1.0.0
 */
class PatternType extends Model
{
  /**
   * @method getEnsuredContext()
   * @method getRejectedContextKeys()
   * @method getRequiredContextKeys()
   */
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
            ['params', 'resolver', 'scaffold'], 'validateIsAssoc',
          ],
          [
            'params', 'default', 'value' => [
              'ensure' => [],
              'reject' => [],
              'require' => [],
            ],
          ],
          ['resolver', 'validateResolverConfig'],
        ];
    }

    public function validateResolverConfig(string $attribute): void
    {
        $resolverConfig = $this->$attribute;
        if (!array_key_exists('class', $resolverConfig)) {
            $this->addError($attribute, 'Resolver class not set');
        }
        if (!class_exists($resolverConfig['class'])) {
            $this->addError($attribute, 'Resolver class does not exist');
        }
        if (!array_key_exists('settings', $resolverConfig)) {
            $this->addError($attribute, 'Resolver settings missing');
        }
    }
    public function validateIsAssoc(string $attribute): bool
    {
        return is_array($this->$attribute) && ArrayHelper::isAssociative($this->$attribute);
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
