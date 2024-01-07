<?php
/*
 * Copyright (c) 2024 by Christoph Willi Regensburger
 *
 * Alle Inhalte dieses Quelltextes sind urheberrechtlich geschützt.
 * Das Urheberrecht liegt, soweit nicht ausdrücklich anders gekennzeichnet,
 * bei Christoph Regensburger.
 * Dieses Projekt wird unter der Lizenz Apache License 2.0 veröffentlicht.
 */

class basicHeader
{

    public static $dir = "";

    public function __construct(string $requestedPath, private readonly string $subsiteName, private readonly array|null $keywords = null)
    {
        if (!str_ends_with($requestedPath, "/")) $requestedPath .= "/";

        $newPath = $requestedPath;
        if (!is_dir($newPath . "util")) {
            do {
                $newPath .= "../";
            } while (!is_dir($newPath . "util"));
        }

        if (!str_ends_with($newPath, "/")) $newPath .= "/";

        if (($len= mb_strlen($requestedPath)) < mb_strlen($newPath)) $newPath = substr($newPath, $len);
        elseif ($len === mb_strlen($newPath)) $newPath = "/";

        self::$dir = $newPath;
    }

    public function __toString(): string
    {
        $dir = self::$dir;
        $themeStyle1 = $dir . "css/pico.fluid.classless.css";
        $themeStyle2 = $dir . "css/pico.css";
        $basicStyle = $dir . "css/BasicStyle.css";
        $navigationStyle = $dir . "css/navbar.css";
        $animateCss = $dir . "css/animate.min.css";
        $sweetalert2 = $dir . "js/sweetalert2.min.js";
        $jQuery = $dir . "js/jquery-3.7.1.min.js";
        $basicStuff = $dir . "js/basicStuff.js";

        return implode(PHP_EOL, ['<meta charset="UTF-8">',
            '<title>' . $this->subsiteName . ' × EzMath</title>',
            '<link rel="icon" href="">',
            '<meta name="image" content="">',
            '<meta name="description" content="">',
            '<meta name="keywords" content=' . (is_array($this->keywords) ? '"' . implode(", ", $this->keywords) . '"' : "") . '>',
            '<meta name="author" content="">',
            '<meta name="viewport" content="width=device-width, initial-scale=1">',
//            '<link rel="stylesheet" href="' . $themeStyle1 . '">',
            '<link rel="stylesheet" href="' . $themeStyle2 . '">',
            '<link rel="stylesheet" href="' . $basicStyle . '">',
            '<link rel="stylesheet" href="' . $navigationStyle . '">',
            '<link rel="stylesheet" href="' . $animateCss . '">',
            '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />',
            '<script src="' . $jQuery . '"></script>',
            '<script src="' . $sweetalert2 . '"></script>',
            ]);
    }

    private function path(string $path): string
    {
        return (new SplFileInfo($path))->getRealPath();
    }
}