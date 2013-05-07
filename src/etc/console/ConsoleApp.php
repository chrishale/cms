<?php
namespace Craft;

/**
 *
 */
class ConsoleApp extends \CConsoleApplication
{
	public $componentAliases;

	/**
	 *
	 */
	public function init()
	{
		// Set default timezone to UTC
		date_default_timezone_set('UTC');

		foreach ($this->componentAliases as $alias)
		{
			Craft::import($alias);
		}

		craft()->getComponent('log');

		// Set our own custom runtime path.
		$this->setRuntimePath(craft()->path->getRuntimePath());

		// No need for these.
		craft()->log->removeRoute('WebLogRoute');
		craft()->log->removeRoute('ProfileLogRoute');

		parent::init();
	}

	/**
	 * @return ConsoleCommandRunner
	 */
	protected function createCommandRunner()
	{
		return new ConsoleCommandRunner();
	}

	/**
	 * Returns whether we are executing in the context on a console app.
	 *
	 * @return bool
	 */
	public function isConsole()
	{
		return true;
	}

	/**
	 * Bogus function.
	 *
	 * @return bool
	 */
	public function isDbConfigValid()
	{
		return true;
	}
}
