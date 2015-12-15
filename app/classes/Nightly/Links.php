<?php
namespace Nightly;

class Links extends Version
{
    public $locale;
    public $base_link = 'https://archive.mozilla.org/pub/firefox/nightly/latest-mozilla-central-l10n/';

    public function __construct($locale='fr')
    {
        parent::__construct();
        $this->locale = $locale;
    }

    public function getFirefoxLinks()
    {
        return [
            'win32' => $this->base_link . 'firefox-' . $this->version . '.' . $this->locale . '.win32.installer.exe',
            'win64' => $this->base_link . 'firefox-' . $this->version . '.' . $this->locale . '.win364.installer.exe',
            'lin32' => $this->base_link . 'firefox-' . $this->version . '.' . $this->locale . '.linux-i686.tar.bz2',
            'lin32' => $this->base_link . 'firefox-' . $this->version . '.' . $this->locale . '.linux-x86_64.tar.bz2',
            'macos' => $this->base_link . 'firefox-' . $this->version . '.' . $this->locale . '.mac.dmg',
        ];
    }
}
