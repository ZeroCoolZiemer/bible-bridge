<?php
function smarty_modifier_highlight($string, $searchTerm)
{
    if (!empty($searchTerm)) {
        $searchTerm = preg_quote($searchTerm, '/');
        
        if (strtolower($searchTerm) == 'hell') {
            $string = preg_replace("/($searchTerm)/i", '<span class="bg-danger text-warning">$1</span>', $string);
        } else {
            $string = preg_replace("/($searchTerm)/i", '<span class="bg-info">$1</span>', $string);
        }
    }
    
    return $string;
}
?>
