<?php

$exception = new Exception('Сообщение об ошибке', 123);

// throw $exception;

try {
    throw new Exception('Сообщение об ошибке', 123);
} catch (Exception $e) {
    echo 'Было поймано исключение: ' . $e->getMessage() . '. Код: ' . $e->getCode();
}