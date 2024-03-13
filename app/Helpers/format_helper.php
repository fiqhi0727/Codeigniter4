<?php 
helper('array');
function format_rupiah($rph)
{
    return number_to_size($rph);
}