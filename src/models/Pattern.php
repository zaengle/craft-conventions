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

use Craft;
use craft\base\Model;
use craft\helpers\ArrayHelper;


use zaengle\conventions\errors\InvalidPatternModelException;
use zaengle\conventions\resolvers\ResolverInterface;

/**
 * @author    Zaengle Corp
 * @package   zaengle\conventions
 * @since     1.0.0
 */
class Pattern extends Model
{
    // Public Properties
    // =========================================================================
    private ?string $_template = null;
    public string|array $paths = [];
    public array $context;
    public ResolverInterface $resolver;
    public PatternType $type;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            ['context', 'validateContext'],
        ];
    }

    /**
     * Get the resolved template
     */
    public function getTemplate(): ?string
    {
        if (!$this->_template) {
            $this->_template = $this->resolver->resolve($this->paths);
        }

        return $this->_template;
    }

    /**
     * Render the Pattern to HTML
     */
    public function render(): ?string
    {
        if (!$this->validate()) {
            throw new InvalidPatternModelException($this);
        }
        if ($this->template && Craft::$app->view->doesTemplateExist($this->template)) {
            return Craft::$app->view->renderTemplate($this->template, $this->getContext());
        } else {
            return $this->handleMissing();
        }
    }

    protected function handleMissing(): ?string
    {
        if ($template = $this->resolver->handleMissing()) {
            return Craft::$app->view->renderTemplate($template, [
                'pattern' => $this,
            ]);
        }

        return null;
    }
    /**
     * Get context with the required keys
     * @return array ctx
     */
    public function getContext(): array
    {
        $ctx = [
            '_pattern' => $this,
        ];
        $ensured = $this->type->getEnsuredContext();

        foreach ($this->getAllKeys($ensured, $this->context) as $key) {
            $relaxedModel = new RelaxedModel();
            if (!isset($this->context[$key])) {
                // use fallback
                $relaxedModel->setAttributes($ensured[$key]);
                $ctx[$key] = $relaxedModel;
            } elseif (!is_array($this->context[$key])) {
                // don't merge, value is probably a query / element
                $ctx[$key] = $this->context[$key];
            } else {
                $relaxedModel->setAttributes(
                    array_merge($ensured[$key] ?? [], $this->context[$key] ?? [])
                );
                $ctx[$key] = $relaxedModel;
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
            if (!property_exists($this->getContext(), $key)) {
                $this->addError($attribute, "Required key `$key` is missing from the context passed to Pattern `$this->template`");
            }
        }
    }

    /**
     *
     */
    protected function getAllKeys(...$arrays): array
    {
        return array_unique(
            array_merge(
                ...array_map(fn($arr) => array_keys($arr), $arrays)
            )
        );
    }
}
