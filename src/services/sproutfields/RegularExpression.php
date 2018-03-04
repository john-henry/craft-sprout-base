<?php
/**
 * @link      https://sprout.barrelstrengthdesign.com/
 * @copyright Copyright (c) Barrel Strength Design LLC
 * @license   http://sprout.barrelstrengthdesign.com/license
 */

namespace barrelstrength\sproutbase\services\sproutfields;

use craft\base\Field;
use yii\base\Component;
use Craft;

/**
 * Class RegularExpression
 *
 */
class RegularExpression extends Component
{
    /**
     * @param       $value
     * @param Field $field
     *
     * @return bool
     */
    public function validate($value, Field $field): bool
    {
        $customPattern = $field->customPattern;

        if (!empty($customPattern)) {
            // Use backticks as delimiters
            $customPattern = '`'.$customPattern.'`';

            if (!preg_match($customPattern, $value)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Return error message
     *
     * @param  mixed $field
     *
     * @return string
     */
    public function getErrorMessage($field): string
    {
        if ($field->customPattern && $field->customPatternErrorMessage) {
            return Craft::t('sprout-base', $field->customPatternErrorMessage);
        }

        return Craft::t('sprout-base', $field->name.' must be a valid pattern.');
    }

}
