<?php

if (!function_exists('trans')) {
    function trans($key, $ar = null, $en = null) {
        if (is_array($key)) {
            return app()->getLocale() == 'ar' ? ($key['ar'] ?? $key['en'] ?? '') : ($key['en'] ?? $key['ar'] ?? '');
        }
        return app()->getLocale() == 'ar' ? ($ar ?? $en ?? '') : ($en ?? $ar ?? '');
    }
}

if (!function_exists('isRTL')) {
    function isRTL() {
        return app()->getLocale() == 'ar';
    }
}
