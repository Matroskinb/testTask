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
		 * @param  string  $optionName    - название элемента
		 * @param  string  $defaultValue  - возвращаемое значение по умолчанию
		 *
		 * @return mixed
		 * @noinspection PhpReturnDocTypeMismatchInspection
		 * @throws \Exception
		 * @author       Eryshev Yuriy <eryshev.p@gmail.com>
		 */
		function config(string $optionName, string $defaultValue = '')
		{
				$projectSettings = include SETTINGS_FILE;

				if (is_array($projectSettings))
				{
						$pathToOption = explode('.', $optionName);

						foreach ($pathToOption as $key)
								if (array_key_exists($key, $projectSettings))
										$projectSettings = $projectSettings[$key];
								elseif ($defaultValue)
										return $defaultValue;
								else
										throw new Exception('Incorrect name');

						/**
						 * P.S. В задании не описан случай, при котором передается имя не конечного элемента в массиве настроек,
						 * поэтому было принято решение не обрабатывать этот кейс. Но можно на этапе возврата значения сделать
						 * проверку вида is_array($projectSettings) и выдать исключение, либо отформатировать массив для вывода.
						 */
						return $projectSettings;
				}
				else
						throw new Exception('Settings not found');
		}

		try
		{
				$firstTest = config('site_url');
				$secondTest = config('db.user');
				$thirdTest = config('app.services.resizer.fallback_format');
				$fourthTest = config('db.host', 'localhost');

				echo "$firstTest $secondTest $thirdTest $fourthTest ";

				$fifthTest = config('invalid.name');
		}
		catch (Exception $e)
		{
				echo $e->getMessage();
		}