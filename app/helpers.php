<?php

if (! function_exists('theme')) {
    function theme($url) {
        return url('node_modules/adminbsb-materialdesign/'.$url);
    }
}
