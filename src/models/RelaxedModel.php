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

use yii\base\UnknownPropertyException;
use yii\base\InvalidCallException;

use craft\base\Model;

/**
 * @author    Zaengle Corp
 * @package   zaengle\conventions
 * @since     1.1.0
 */
class RelaxedModel extends Model
{
    protected array $_attributes = [];

    /**
     * Set passed attributes on the model if the don't exist already
     * @param array $values assoc array of attr names => values
     */
    public function setMissingAttributes(array $values): void
    {
        foreach ($values as $attrName => $value) {
            if (
                !property_exists($this, $attrName) 
                && 
                !method_exists($this, $attrName)
            ) {
                $this->setAttributes([ $attrName => $values[$attrName] ], false);
            }
        }
    }

    /**
     * Allow unsafe attrs
     *
     * @inheritdoc
     */
    public function setAttributes($values, $safeOnly = false): void
    {
        $this->_attributes = array_unique(array_merge($this->_attributes, array_keys($values)));

        parent::setAttributes($values, $safeOnly);
    }

    /**
     * Allow unsafe attrs
     *
     * @inheritdoc
     */
    public function attributes()
    {
        return array_merge(parent::attributes(), $this->_attributes);
    }

    /**
     * Allow getting dynamic properties
     *
     * @inheritdoc
     */
    public function __get($name)
    {
        try {
            parent::__get($name);
        } catch (UnknownPropertyException $e) {
            if (property_exists($this, $name)) {
                return $this->$name;
            }
            throw new UnknownPropertyException('Getting unknown property: ' . get_class($this) . '::' . $name);
        }
    }

    /**
     * Allow setting non-existent properties
     * 
     * @inheritdoc
     */
    public function __set($name, $value)
    {
        try {
            parent::__set($name, $value);
        } catch (UnknownPropertyException $e) {
            // Instead of throwing exception, just add the property
            $this->_attributes = array_unique(array_merge($this->_attributes, [$name]));
            $this->$name = $value;
        }
    }

    /**
     * Checks for dynamic properties
     * 
     * @inheritdoc
     */
    public function __isset($name)
    {
        return property_exists($this, $name) || parent::__isset($name);
    }

    /**
     * Checks for dynamic properties
     * 
     * @inheritdoc
     */
    public function __unset($name)
    {
        try {
            parent::__unset($name);
        } catch (InvalidCallException $e) {
            if (property_exists($this, $name)) {
                $this->$name = null;
            } else {
                throw new InvalidCallException('Unsetting non-existent property: ' . get_class($this) . '::' . $name);
            }
        }
    }

    /**
     * Calls the named method which is not a class method.
     *
     * @inheritdoc
     */
    public function __call($name, $params)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        } else {
            return null;
        }
    }

}
