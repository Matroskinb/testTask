<?php

/** Путь к файлу настроек */
const SETTINGS_FILE = 'settings.php';

/**
 * Получить значение элемента конфигурации
 *
 * Функция пытается найти указанное в $optionName значение внутри массива с конфигурацией settings.php, в случае
 * отсутствия значения возвращает значение по умолчанию, передаваемое в $defaultValue. Если значение не передано,
 * то выбрасывается исключение.
 *
 * @param string $optionName - название элемента
 * @param mixed $defaultValue - возвращаемое значение по умолчанию
 *
 * @return mixed
 * @throws Exception
 * @author       Eryshev Yuriy <eryshev.p@gmail.com>
 */
function config(string $optionName, $defaultValue = null)
{
    $projectSettings = null;

    if (file_exists(SETTINGS_FILE) && is_array($projectSettings = include SETTINGS_FILE)) {
        $pathToOption = explode('.', $optionName);

        foreach ($pathToOption as $key) {
            if (array_key_exists($key, $projectSettings)) {
                $projectSettings = $projectSettings[$key];
            } elseif (!is_null($defaultValue)) {
                return $defaultValue;
            } else {
                throw new Exception('Incorrect name');
            }
        }

        return $projectSettings;
    } else {
        throw new Exception('Settings not found');
    }
}

try {
    $firstTest = config('site_url');
    $secondTest = config('db.user');
    $thirdTest = config('app.services.resizer.fallback_format');
    $fourthTest = config('db.host', []);

    echo "$firstTest $secondTest $thirdTest $fourthTest ";

    $fifthTest = config('invalid.name');
} catch (Exception $e) {
    echo $e->getMessage();
}