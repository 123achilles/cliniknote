<?php

function array_convert_key_case(array $array,  $callback = 'strtolower')
{
    return array_combine(
        array_map($callback, array_keys($array)),
        array_values($array)
    );
}
