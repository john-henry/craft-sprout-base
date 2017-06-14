<?php

namespace barrelstrength\sproutcore;

use craft;
use yii\base\Event;
use craft\web\UrlManager;
use craft\events\RegisterUrlRulesEvent;
use craft\web\View;
use craft\events\RegisterTemplateRootsEvent;
use craft\helpers\ArrayHelper;
use craft\i18n\PhpMessageSource;

class Module extends \yii\base\Module
{
	public $handle;

	/**
	 * @var string|null The translation category that this plugin’s translation messages should use. Defaults to the lowercased plugin handle.
	 */
	public $t9nCategory;

	/**
	 * @var string The language that the plugin’s messages were written in
	 */
	public $sourceLanguage = 'en-US';

	/**
	 * @inheritdoc
	 */
	public function __construct($id, $parent = null, array $config = [])
	{
		// Set some things early in case there are any settings, and the settings model's
		// init() method needs to call Craft::t() or Plugin::getInstance().

		$this->handle = 'sproutcore';
		$this->t9nCategory = ArrayHelper::remove($config, 't9nCategory', $this->t9nCategory ?? strtolower($this->handle));
		$this->sourceLanguage = ArrayHelper::remove($config, 'sourceLanguage', $this->sourceLanguage);

		if (($basePath = ArrayHelper::remove($config, 'basePath')) !== null) {
			$this->setBasePath($basePath);
		}

		// Translation category
		$i18n = Craft::$app->getI18n();
		/** @noinspection UnSafeIsSetOverArrayInspection */
		if (!isset($i18n->translations[$this->t9nCategory]) && !isset($i18n->translations[$this->t9nCategory.'*'])) {
			$i18n->translations[$this->t9nCategory] = [
				'class' => PhpMessageSource::class,
				'sourceLanguage' => $this->sourceLanguage,
				'basePath' => $this->getBasePath().DIRECTORY_SEPARATOR.'translations',
				'allowOverrides' => true,
			];
		}

		// Set this as the global instance of this plugin class
		static::setInstance($this);

		parent::__construct($id, $parent, $config);
	}

	public function init()
	{
		parent::init();

		$this->params['foo'] = 'bar';
		// ...  other initialization code ...

		// Register our base template path
		Event::on(View::class, View::EVENT_REGISTER_CP_TEMPLATE_ROOTS, function(RegisterTemplateRootsEvent $e) {
			$e->roots['sprout-core'] = $this->getBasePath().DIRECTORY_SEPARATOR.'templates';
		});

		// Register custom routes
		Event::on(UrlManager::class, UrlManager::EVENT_REGISTER_CP_URL_RULES, function(RegisterUrlRulesEvent $event) {
			$event->rules['sprout-settings'] = 'sprout-core/stuff/settings';
			$event->rules['sprout-settings/<pluginName:.*>'] = 'sprout-core/stuff/settings';;
		});
	}

	/**
	 * @param string $message
	 * @param array  $params
	 *
	 * @return string
	 */
	public static function t($message, array $params = [])
	{
		return Craft::t('sproutcore', $message, $params);
	}

	public function sproutReports()
	{
		return 'cat';
	}
}
