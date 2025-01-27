<?php
namespace Nightly;

use Cache\Cache;

class Version
{
    public $version;
    public $json_source = 'https://product-details.mozilla.org/1.0/firefox_versions.json';
    public $base_link = 'https://download.mozilla.org/';

    public function __construct()
    {
        $this->version = $this->getNightlyNumber();
    }

    /**
     * Return the version number for Firefox Nightly
     */
    private function getNightlyNumber():string
    {
        if (Cache::isActivated()) {
            $cache_id = "product_details";
            if (! $json_data = Cache::getKey($cache_id)) {
                // No cache for this request. Read remote and cache answer on disk.
                $json_data = json_decode(file_get_contents($this->json_source), true);
                if ($json_data !== null) {
                    Cache::setKey($cache_id, $json_data);
                }
            }
        } else {
            // Cache is disabled. Just read the value.
            $json_data = json_decode(file_get_contents($this->json_source), true);
        }

        return $json_data['FIREFOX_NIGHTLY'];
    }

    /**
     * Get an array of valid Firefox nightly links per Desktop platform
     */
    public function getFirefoxLinks():array
    {
        $lead_link = $this->base_link . '?product=firefox-nightly-latest-l10n-ssl&lang=fr&os=';

        return [
            'win32' => $lead_link . 'win',
            'win64' => $lead_link . 'win64',
            'lin32' => $lead_link . 'linux',
            'lin64' => $lead_link . 'linux64',
            'macos' => $lead_link . 'osx',
        ];
    }
}
