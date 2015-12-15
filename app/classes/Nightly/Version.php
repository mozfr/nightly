<?php
namespace Nightly;

class Version
{
    public $version;
    public $json_source;

    public function __construct($source='https://svn.mozilla.org/libs/product-details/json/firefox_versions.json')
    {
        $this->json_source = $source;
        $this->getNightlyNumber();
    }

    public function getNightlyNumber()
    {
        $nightly = explode('.', json_decode(file_get_contents($this->json_source), true)['FIREFOX_AURORA']);
        $nightly[0]++;
        $nightly[1] = str_replace('2', '1', $nightly[1]);

        $this->version = implode('.', $nightly);

        return $this;
    }
}
