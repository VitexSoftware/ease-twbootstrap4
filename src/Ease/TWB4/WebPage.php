<?php

namespace Ease\TWB4;

/**
 * Stránka TwitterBootstrap4.
 *
 * @author     Vítězslav Dvořák <vitex@hippy.cz>
 * @copyright  2017 Vitex@vitexsoftware.cz (G)
 *
 * @link       http://twitter.github.com/bootstrap/index.html
 */
class WebPage extends \Ease\WebPage {

    /**
     * Where to look for bootstrap stylesheet
     * @var string path or url 
     */
    public $bootstrapCSS = 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css';

    /**
     * Where to look for bootstrap stylesheet theme
     * @var string path or url 
     */
    public $bootstrapThemeCSS = '';

    /**
     * Where to look for bootstrap stylesheet scripts
     * @var string path or url 
     */
    public $bootstrapJavaScript = 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.js';
    public $header = null;
    public $main = null;
    public $footer = null;

    /**
     * Stránka s podporou pro twitter bootstrap.
     *
     * @param string   $pageTitle
     */
    public function __construct($pageTitle = null) {
        parent::__construct($pageTitle);
        Part::twBootstrapize();

        $this->head->addItem(
                '<meta charset="utf-8">' .
                '<meta name="viewport" content="width=device-width, initial-scale=1">'
        );
    }

    public function addToHeader($content) {
        if (is_null($this->header)) {
            $this->header = new \Ease\Html\HeaderTag();
        }
        return $this->header->addItem($content);
    }

    public function addToMain($content) {
        if (is_null($this->main)) {
            $this->main = new \Ease\Html\MainTag();
        }
        return $this->main->addItem($content);
    }

    public function addToFooter($content) {
        if (is_null($this->footer)) {
            $this->footer = new \Ease\Html\FooterTag();
        }
        return $this->footer->addItem($content);
    }

    public function finalize() {
        if (is_null($this->header) === false) {
            $this->addAsFirst($this->header);
        }
        if (is_null($this->main) === false) {
            $this->addItem($this->main);
        }
        if (is_null($this->footer) === false) {
            $this->addItem($this->footer);
        }
        parent::finalize();
    }

}
