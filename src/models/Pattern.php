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
class Pattern extends Model
{
    // Public Properties
    // =========================================================================
    public string $template;
    public array $context;
    public PatternType $type;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            ['template', 'string'],
            [['template', 'type'], 'required'],
            ['context', 'validateContext'],
        ];
    }

    /**
     * Get context with the required keys
     * @return array ctx
     */
    public function getContext(): array
    {
        $ctx = [];
        $ensured = $this->type->getEnsuredContext();

        $allKeys = array_unique(
            array_merge(
                array_keys($ensured), array_keys($this->context)
            )
        );

        foreach ($allKeys as $key) {
            if (!isset($this->context[$key])) {
                // use fallback
                $ctx[$key] = $ensured[$key];
            } elseif (!is_array($this->context[$key])) {
                // don't merge
                $ctx[$key] = $this->context[$key];
            } else {
                //merge
                $ctx[$key] = array_merge_recursive($ensured[$key] ?? [], $this->context[$key] ?? []);
            }
        }

        return $ctx;
    }

    /**
     * Validate the passed context
     * @param  string $attribute
     * @return void
     */
    public function validateContext(string $attribute): void
    {
        $this->validateIsAssoc($attribute);
        $this->validateRejectContextKeys($attribute);
        $this->validateRequiredContextKeys($attribute);
    }

    public function validateIsAssoc(string $attribute): void
    {
        if (!is_array($this->$attribute) || !ArrayHelper::isAssociative($this->$attribute)) {
            $this->addError($attribute, 'must be an associative array');
        }
    }

    /**
     * Ensure non-permitted keys not passed in the context
     * @param string $attribute
     */
    protected function validateRejectContextKeys(string $attribute): void
    {
        foreach ($this->type->getRejectedContextKeys() as $key) {
            if (array_key_exists($key, $this->context)) {
                $this->addError($attribute, "Key `$key` is not permitted in the context passed to Pattern `$this->template`");
            }
        }
    }

    /**
     * Ensure required keys are present in the context
     * @param string $attribute
     */
    protected function validateRequiredContextKeys(string $attribute): void
    {
        foreach ($this->type->getRequiredContextKeys() as $key) {
            if (!array_key_exists($key, $this->getContext())) {
                $this->addError($attribute, "Required key `$key` is missing from the context passed to Pattern `$this->template`");
            }
        }
    }
}
