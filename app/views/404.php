<?php

print $twig->render(
    '404.html.twig',
    [
        'path'    => $webroot_folder,
    ]

);
