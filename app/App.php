<?php

define('Y_TIME', time());

require __DIR__ . '/../vendor/autoload.php';

class App extends Youngx\MVC\Application
{
    protected function registerBundles()
    {
        return array(
            new Youngx\Bundle\KernelBundle\KernelBundle(),
            new Youngx\Bundle\AdminBundle\AdminBundle(array(
                new Youngx\Bundle\AdminBundle\Module\AceModule\AceModule(),
                new Youngx\Bundle\UserBundle\Module\AdminUserModule\AdminUserModule(),
                new Youngx\Bundle\DistrictBundle\Module\AdminDistrictModule\AdminDistrictModule(),
                new Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\AdminArchiveModule(),
                new Youngx\Bundle\PageBundle\Module\AdminPageModule\AdminPageModule(),
                new Youngx\Bundle\LocaleBundle\Module\AdminLocaleModule\AdminLocaleModule(),
                new Youngx\Bundle\VocabularyBundle\Module\AdminVocabularyModule\AdminVocabularyModule(),
                new Youngx\Bundle\FeedbackBundle\Module\AdminFeedbackModule\AdminFeedbackModule(),
            )),
            new Youngx\Bundle\FrontBundle\FrontBundle(array(
                new Youngx\Bundle\PageBundle\Module\FrontPageModule\FrontPageModule(),
                new Youngx\Bundle\FeedbackBundle\Module\FrontFeedbackModule\FrontFeedbackModule(),
            )),
            new Youngx\Bundle\LocaleBundle\LocaleBundle(),
            new Youngx\Bundle\jQueryBundle\jQueryBundle(),
            new Youngx\Bundle\UserBundle\UserBundle(),
            new Youngx\Bundle\BootstrapBundle\BootstrapBundle(),
            new Youngx\Bundle\UMEditorBundle\UMEditorBundle(),
            new Youngx\Bundle\CKEditorBundle\CKEditorBundle(),
            new Youngx\Bundle\CKFinderBundle\CKFinderBundle(),
            new Youngx\Bundle\ArchiveBundle\ArchiveBundle(),
            new Youngx\Bundle\DistrictBundle\DistrictBundle(),
            new Youngx\Bundle\VocabularyBundle\VocabularyBundle(),
            new Youngx\Bundle\PageBundle\PageBundle(),
            new \Youngx\Bundle\FeedbackBundle\FeedbackBundle(),
        );
    }

    protected function registerLocations()
    {
        $this->registerLocator('app', __DIR__)
            ->registerLocator('cache', "site://cache/{$this->getEnvironment()}")
            ->registerLocator('public', 'web://public', '/public')
            ->registerLocator('assets', 'web://assets', '/assets');
    }
}
