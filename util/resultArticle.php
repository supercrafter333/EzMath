<?php
/*
 * Copyright (c) 2024 by Christoph Willi Regensburger
 *
 * Alle Inhalte dieses Quelltextes sind urheberrechtlich geschützt.
 * Das Urheberrecht liegt, soweit nicht ausdrücklich anders gekennzeichnet,
 * bei Christoph Regensburger.
 * Dieses Projekt wird unter der Lizenz Apache License 2.0 veröffentlicht.
 */

class resultArticle
{
    public function __construct(private readonly string|int|float $result = "", private readonly string|null $resultTypeName = null, private readonly int $elementCount = 0, private readonly string|null $unit = null) {}

    public function __toString(): string
    {
        $extraLine = is_string($this->resultTypeName) ? '<h4 style="text-align: center;">' . $this->resultTypeName . '</h4>' : "";
        return implode(PHP_EOL, [
            '<article class="resArticle">',
                $extraLine,
                '<h2 style="margin-bottom: 5px; text-align: center;">Ergebnis:</h2>',
                '<div style="display: flex; margin: 0; justify-content: center;">',
                    '<p style="'. ($this->unit === null ? "margin-right: 6px;" : "margin-right: 4px;") . ' font-size: 1.5rem;" class="result">' . $this->result . '</p>',
                    ($this->unit !== null ? '<p style="margin-right: 10px; font-size: 1.5rem;">' . $this->unit . '</p>' : ""),
                    '<span onclick="copyResult(' . $this->elementCount . ')" class="material-symbols-outlined" style="font-size: 2.5rem;" data-tooltip="In Zwischenablage kopieren">content_paste</span>',
                '</div>',
            '</article>',
            '<script src="' . basicHeader::$dir . 'js/basicStuff.js"></script>'
        ]);
    }
}