<?php

print $twig->render(
    'home.html.twig',
    [
        'version' => $current->version,
        'links'   => $current->getFirefoxLinks(),
        'path'    => $webroot_folder
    ]

);
