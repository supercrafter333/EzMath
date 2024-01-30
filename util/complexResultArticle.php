<?php

readonly class complexResultArticle
{
    public function __construct(private string $searched, private array $given, private string $operationMethod, private string|int|float $result = "", private string|null $resultTypeName = null, private int $elementCount = 0, private string|null $unit = null, private array|null $calcWay = null) {}

    public function __toString(): string
    {
        $givenStr = [];
        foreach ($this->given as $item => $value)
            $givenStr[] = '<p style="margin: 0;"><b>' . $item . ':</b> ' . $value . '</p>';

        $calcWay = "";
        $finalCalcWay = null;
        if (is_array($this->calcWay)) {
            foreach ($this->calcWay as $way)
                $calcWay .= $way . "<br>";

            $finalCalcWay = implode(PHP_EOL, [
                "<script>",
                "function calcWay() {",
                "Swal.fire({",
                "title: 'Rechenweg',",
                "html: '" . $calcWay . "',",
                "icon: 'question'",
                "});",
                "}",
                "</script>",
            ]);
        }

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
            '<div class="complexResArtBg" style="padding: 10px;">',
            '<h3>Werte:</h3>',
            '<p style="margin: 0;"><b>Operation:</b> ' . $this->operationMethod . '</p>',
            '<p style="margin: 0;"><b>Gesucht:</b> ' . $this->searched . '</p>',
            implode(PHP_EOL, $givenStr),
            $finalCalcWay !== null ? "<br><button onclick='calcWay()' class='outline contrast' style='cursor: help;'>Rechenweg</button>" : "",
            '</div>',
            '</article>',
            '<script src="' . basicHeader::$dir . 'js/basicStuff.js"></script>',
            $finalCalcWay,
        ]);
    }
}