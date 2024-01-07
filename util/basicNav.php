<?php
/*
 * Copyright (c) 2024 by Christoph Willi Regensburger
 *
 * Alle Inhalte dieses Quelltextes sind urheberrechtlich geschützt.
 * Das Urheberrecht liegt, soweit nicht ausdrücklich anders gekennzeichnet,
 * bei Christoph Regensburger.
 * Dieses Projekt wird unter der Lizenz Apache License 2.0 veröffentlicht.
 */

class basicNav
{
    public function __construct(private readonly string $currentSite = "Home") {}

    public function __toString(): string
    {
        $hrefPreset = basicHeader::$dir;

        $cfgContent = json_decode(file_get_contents(($hrefPreset === "/" ? "" : $hrefPreset) . "pub_cfg/navbar.json"));
        $navContent = [];
        foreach ($cfgContent as $site => $path) {
            $navContent[] = '<li><a href="' . ($hrefPreset === "/" ? "" : $hrefPreset) . $path . '">' . $site . '</a></li>';
        }

        return implode(PHP_EOL, [
            '<nav>',
                '<div class="nav-logo">Logo</div>',
                '<div class="nav-toggle">',
                    '<span class="material-symbols-outlined">menu</span>',
                '</div>',
                '<div class="nav-content animate__animated">',
                    '<ul>',
                        implode(PHP_EOL, $navContent),
                    '</ul>',
                '</div>',
            '</nav>',
            '<script src="' . $hrefPreset . 'js/navbar.js"></script>'
        ]);
    }
}