<?

		/**
		 * Получить значение элемента конфигурации
		 *
		 * Функция пытается найти указанное в $optionName значение внутри массива с конфигурацией settings.php, в случае
		 * отсутствия значения возвращает значение по умолчанию, передаваемое в $defaultValue. Если значение не передано, то
		 * выбрасывается исключение.
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
				$projectSettings = include_once 'settings.php';

				if (is_array($projectSettings))
				{
						$pathToOption = explode('.', $optionName);

						foreach ($pathToOption as $key)
								if (array_key_exists($key, $projectSettings))
										$projectSettings = $projectSettings[$key];
								elseif ($defaultValue)
										return $defaultValue;
								else
										throw new Exception('Incorrect path');

						/**
						 * В задании не описан случай, при котором передается путь не до конечного элемента в массиве настроек,
						 * поэтому было принято решение не обрабатывать этот кейс. Но можно на этапе возврата значения сделать
						 * проверку вида is_array($projectSettings) и выдать исключение, либо отформатировать массив для вывода
						 */
						return $projectSettings;
				}
				else
						throw new Exception('Settings not found');
		}

		try
		{
				echo config("assets");
		}
		catch (Exception $e)
		{
				echo $e->getMessage();
		}