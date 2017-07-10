<?php
/**
 * Маршруты.
 */
return [
    '' => 'main/index',
    'signin' => 'main/signin',
    'signout' => 'main/signout',
    'book/([0-9]+)' => 'book/view/$1',
    'catalog/(index|other)' => 'catalog/$1',
];
