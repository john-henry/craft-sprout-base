<?php
/**
 * @link      https://sprout.barrelstrengthdesign.com/
 * @copyright Copyright (c) Barrel Strength Design LLC
 * @license   http://sprout.barrelstrengthdesign.com/license
 */

namespace barrelstrength\sproutbase\services;

use barrelstrength\sproutbase\app\email\services\Mailers;
use barrelstrength\sproutbase\app\email\services\NotificationEmailEvents;
use barrelstrength\sproutbase\app\email\services\NotificationEmails;
use barrelstrength\sproutbase\app\fields\services\EmailDropdown;
use barrelstrength\sproutbase\app\import\services\FieldImporter;
use barrelstrength\sproutbase\app\import\services\Seed;
use barrelstrength\sproutbase\app\import\services\SettingsImporter;
use barrelstrength\sproutbase\app\import\services\Bundles;
use barrelstrength\sproutbase\app\import\services\ElementImporter;
use barrelstrength\sproutbase\app\import\services\ImportUtilities;
use barrelstrength\sproutbase\app\reports\services\DataSources;
use barrelstrength\sproutbase\app\reports\services\Exports;
use barrelstrength\sproutbase\app\reports\services\ReportGroups;
use barrelstrength\sproutbase\app\reports\services\Reports;
use barrelstrength\sproutbase\app\fields\services\Utilities;
use barrelstrength\sproutbase\app\fields\services\Url;
use barrelstrength\sproutbase\app\fields\services\Phone;
use barrelstrength\sproutbase\app\fields\services\RegularExpression;
use barrelstrength\sproutbase\app\fields\services\Email;
use barrelstrength\sproutbase\app\fields\services\Address;
use barrelstrength\sproutbase\app\import\services\Importers;
use craft\base\Component;
use barrelstrength\sproutbase\app\email\services\EmailTemplates as SproutEmail;

class App extends Component
{
    /**
     * @var Address
     */
    public $addressField;

    /**
     * @var Phone
     */
    public $phoneField;

    /**
     * @var Utilities
     */
    public $utilities;

    /**
     * @var Url
     */
    public $urlField;

    /**
     * @var Email
     */
    public $emailField;

    /**
     * @var EmailDropdown
     */
    public $emailDropdownField;

    /**
     * @var RegularExpression
     */
    public $regularExpressionField;

    /**
     * @var Reports
     */
    public $reports;

    /**
     * @var ReportGroups
     */
    public $reportGroups;

    /**
     * @var NotificationEmails
     */
    public $notifications;

    /**
     * @var NotificationEmailEvents
     */
    public $notificationEvents;

    /**
     * @var DataSources
     */
    public $dataSources;

    /**
     * @var Exports
     */
    public $exports;

    /**
     * @var Settings
     */
    public $settings;

    /**
     * @var Mailers
     */
    public $mailers;

    /**
     * @var Importers
     */
    public $importers;

    /**
     * @var Bundles
     */
    public $bundles;

    /**
     * @var SproutEmail
     */
    public $sproutEmail;

    /**
     * @var ElementImporter
     */
    public $elementImporter;

    /**
     * @var SettingsImporter
     */
    public $settingsImporter;

    /**
     * @var FieldImporter
     */
    public $fieldImporter;

    /**
     * @var ImportUtilities
     */
    public $importUtilities;

    /**
     * @var Seed
     */
    public $seed;

    /**
     * @inheritdoc
     */
    public function init()
    {
        // Sprout Base
        $this->settings = new Settings();

        // Sprout Email
        $this->mailers = new Mailers();
        $this->notificationEvents = new NotificationEmailEvents();
        $this->notifications = new NotificationEmails();

        // @todo - Rename this to EmailTemplates or something more appropriate
        $this->sproutEmail = new SproutEmail();

        // Sprout Fields
        $this->addressField = new Address();
        $this->emailField = new Email();
        $this->emailDropdownField = new EmailDropdown();
        $this->phoneField = new Phone();
        $this->regularExpressionField = new RegularExpression();
        $this->urlField = new Url();
        $this->utilities = new Utilities();

        // Sprout Reports
        $this->dataSources = new DataSources();
        $this->exports = new Exports();
        $this->reportGroups = new ReportGroups();
        $this->reports = new Reports();

        // Sprout Import
        $this->bundles = new Bundles();
        $this->elementImporter = new ElementImporter();
        $this->fieldImporter = new FieldImporter();
        $this->importers = new Importers();
        $this->importUtilities = new ImportUtilities();
        $this->seed = new Seed();
        $this->settingsImporter = new SettingsImporter();
    }
}
