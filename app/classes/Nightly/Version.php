<?php
namespace Nightly;

use Cache\Cache;

class Version
{
    public $version;
    public $json_source = 'https://product-details.mozilla.org/1.0/firefox_versions.json';
    public $base_link = 'https://archive.mozilla.org/pub/firefox/nightly/latest-mozilla-central-l10n/';

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
        $lead_link = $this->base_link . 'firefox-' . $this->version . '.' . $this->locale . '.';

        return [
            'win32' => $lead_link . 'win32.installer.exe',
            'win64' => $lead_link . 'win64.installer.exe',
            'lin32' => $lead_link . 'linux-i686.tar.xz',
            'lin64' => $lead_link . 'linux-x86_64.tar.xz',
            'macos' => $lead_link . 'mac.dmg',
        ];
    }
}
