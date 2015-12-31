<?php
namespace Nightly;

use Cache\Cache;

class Version
{
    public $version;
    public $json_source = 'https://svn.mozilla.org/libs/product-details/json/firefox_versions.json';
    public $base_link = 'https://archive.mozilla.org/pub/firefox/nightly/latest-mozilla-central-l10n/';

    public function __construct($locale = 'fr')
    {
        $this->locale = $locale;
        $this->version = $this->getNightlyNumber();
    }

    /**
     * Return the version number for Firefox Nightly based on the latest Aurora
     *
     * @return string version number for Nightly
     */
    public function getNightlyNumber()
    {
        $nightly = explode('.', $this->getAuroraNumber());
        $nightly[0]++;
        $nightly[1] = str_replace('2', '1', $nightly[1]);

        return implode('.', $nightly);
    }

    /**
     * Return the version number for Firefox Aurora
     *
     * @return string version number for Aurora
     */
    private function getAuroraNumber()
    {
        $cache_id = "product_details";
        if (Cache::isActivated()) {
            if (! $json_data = Cache::getKey($cache_id)) {
                // No cache for this request. Read remote and cache answer on disk.
                $json_data = json_decode(file_get_contents($this->json_source), true)['FIREFOX_AURORA'];
                if ($json_data !== null) {
                    Cache::setKey($cache_id, $json_data);
                }
            }
        } else {
            // Cache is disabled. Just read the value.
            $json_data = json_decode(file_get_contents($this->json_source), true)['FIREFOX_AURORA'];
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
            'lin32' => $lead_link . 'linux-i686.tar.bz2',
            'lin64' => $lead_link . 'linux-x86_64.tar.bz2',
            'macos' => $lead_link . 'mac.dmg',
        ];
    }
}
