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
            [['template', 'context', 'type'], 'required'],
            ['context', 'validateContext'],
        ];
    }
    /**
     * Get context with the required keys
     * @return array ctx
     */
    public function getEnsuredContext(): array
    {
        return array_merge_recursive($this->type->getEnsuredContext(), $this->context);
    }

    /**
     * Validate the passed context
     * @param  string $attribute
     * @return void
     */
    public function validateContext(string $attribute): void
    {
        $this->validateRejectContextKeys();
        $this->validateRequiredContextKeys();
    }

    /**
     * Ensure non-permitted ctx keys not passed
     * @return void 
     */
    protected function validateRejectContextKeys(): void
    {
        foreach ($this->type->getRejectedContextKeys() as $key) {
            if (array_key_exists($key, $this->context)) {
                $this->addError("Key `{$key}` is not permitted in context passed to Pattern {$this->template}");
            }
        }
    }
    protected function validateRequiredContextKeys(): void
    {
        foreach ($this->type->getRequiredContextKeys() as $key) {
            if (!array_key_exists($key, $this->context)) {
                $this->addError("Required key `{$key}` is missing from context passed to Pattern {$this->template}");
            }
        }
    }
}
