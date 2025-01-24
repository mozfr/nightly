<?php
namespace Nightly;

use Cache\Cache;

class Version
{
    public $version;
    public $json_source = 'https://product-details.mozilla.org/1.0/firefox_versions.json';
    public $base_link = 'https://download.mozilla.org/';

    public function __construct($locale = 'fr')
    {
        $this->locale = $locale;
        $this->version = $this->getNightlyNumber();
    }

    /**
     * Return the version number for Firefox Nightly
     *
     * @return string version number for Nightly
     */
    private function getNightlyNumber()
    {
        $cache_id = "product_details";
        if (Cache::isActivated()) {
            if (! $json_data = Cache::getKey($cache_id)) {
                // No cache for this request. Read remote and cache answer on disk.
                $json_data = json_decode(file_get_contents($this->json_source), true)['FIREFOX_NIGHTLY'];
                if ($json_data !== null) {
                    Cache::setKey($cache_id, $json_data);
                }
            }
        } else {
            // Cache is disabled. Just read the value.
            $json_data = json_decode(file_get_contents($this->json_source), true)['FIREFOX_NIGHTLY'];
        }

        return $json_data;
    }

    /**
     * Get an array of valid Firefox nightly links per Desktop platform
     *
     *   @return array Links for all platforms
     */
    public function getFirefoxLinks()
    {
        $lead_link = $this->base_link . '?product=firefox-nightly-latest-l10n-ssl&lang=' . $this->locale;

        return [
            'win32' => $lead_link . '&os=win',
            'win64' => $lead_link . '&os=win64',
            'lin32' => $lead_link . '&os=linux',
            'lin64' => $lead_link . '&os=linux64',
            'macos' => $lead_link . '&os=osx',
        ];
    }
}
