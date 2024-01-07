<?php

include "basicHeader.php";

class headerWithCaptcha extends basicHeader
{

    public function __toString(): string
    {
        $str =  parent::__toString();
        $str .= implode(PHP_EOL, [
            '<script>',
            'function onSubmit(token) {',
            '    alert("thanks " + document.getElementById("field").value);',
            '}',
            '',
            'function validate(event) {',
            '    event.preventDefault();',
            '    if (!document.getElementById("field").value) {',
            '        alert("You must add text to the required field");',
            '    } else {',
            '        grecaptcha.execute();',
            '    }',
            '}',
            '',
            'function onload() {',
            '    var element = document.getElementById("submit");',
            '    element.onclick = validate;',
            '}',
          '</script>',
          '<script src="https://www.google.com/recaptcha/api.js" async defer></script>',
        ]);
        return $str;
    }
}