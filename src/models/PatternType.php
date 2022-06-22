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

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
          [
            ['resolver'], 'required',
          ],
          [
            ['params', 'resolver'], 'validateIsAssoc',
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
            $this->addError($attribute, 'class not set');
        }
        if (!class_exists($resolverConfig['class'])) {
            $this->addError($attribute, 'class does not exist');
        }
        if (!array_key_exists('settings', $resolverConfig)) {
            $this->addError($attribute, 'settings missing');
        }
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

    public function validateIsAssoc(string $attribute): void
    {
        if (!is_array($this->$attribute) || !ArrayHelper::isAssociative($this->$attribute)) {
            $this->addError($attribute, 'must be an associative array');
        }
    }
}
