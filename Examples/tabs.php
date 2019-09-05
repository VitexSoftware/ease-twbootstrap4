<?php

namespace Ease\Example;

include_once dirname(__DIR__).'/vendor/autoload.php';

$oPage = new \Ease\TWB4\WebPage('Twitter Bootstrap 4 Tabs Example');

$tabs = ['Home' => 'Home Tab Content', 'Profile' => 'Profile Tab Content', 'Contact' => 'Contact Tab contents'];

$oPage->addItem(new \Ease\TWB4\Tabs($tabs, ['id' => 'myTab']));

$oPage->draw();
