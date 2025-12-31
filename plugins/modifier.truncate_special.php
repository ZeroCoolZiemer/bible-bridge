<?php
function smarty_modifier_truncate_special($string, $lengthWithNumber = 6, $lengthWithoutNumber = 4, $suffix = '.')
{
    if (preg_match('/^\d/', $string)) {
        return mb_strimwidth($string, 0, $lengthWithNumber, '.');
    } else {
        return mb_strimwidth($string, 0, $lengthWithoutNumber, $suffix);
    }
}
?>
