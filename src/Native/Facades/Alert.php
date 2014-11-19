<?php namespace Cartalyst\Notifications\Native\Facades;
/**
 * Part of the Notifications package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Cartalyst PSL License.
 *
 * This source file is subject to the Cartalyst PSL License that is
 * bundled with this package in the license.txt file.
 *
 * @package    Notifications
 * @version    1.0.0
 * @author     Cartalyst LLC
 * @license    Cartalyst PSL
 * @copyright  (c) 2011-2014, Cartalyst LLC
 * @link       http://cartalyst.com
 */

use Cartalyst\Notifications\Native\NotificationsBootstrapper;

class Alert {

	/**
	 * The notifications instance.
	 *
	 * @var \Cartalyst\Notifications\Notifications
	 */
	protected $notifications;

	/**
	 * The Native Bootstraper instance.
	 *
	 * @var \Cartalyst\Notifications\Native\NotificationsBootstrapper
	 */
	protected static $instance;

	/**
	 * Constructor.
	 *
	 * @param  \Cartalyst\Notifications\Native\NotificationsBootstrapper  $bootstrapper
	 * @return void
	 */
	public function __construct(NotificationsBootstrapper $bootstrapper = null)
	{
		if ($bootstrapper === null)
		{
			$bootstrapper = new NotificationsBootstrapper;
		}

		$this->notifications = $bootstrapper->createNotifications();
	}

	/**
	 * Returns the Notifications instance.
	 *
	 * @return \Cartalyst\Notifications\Notifications
	 */
	public function getNotifications()
	{
		return $this->notifications;
	}

	/**
	 * Creates a new Native Bootstraper instance.
	 *
	 * @param  \Cartalyst\Notifications\Native\NotificationsBootstrapper  $bootstrapper
	 * @return void
	 */
	public static function instance(NotificationsBootstrapper $bootstrapper = null)
	{
		if (static::$instance === null)
		{
			static::$instance = new static($bootstrapper);
		}

		return static::$instance;
	}

	/**
	 * Handle dynamic, static calls to the object.
	 *
	 * @param  string  $method
	 * @param  array  $args
	 * @return mixed
	 */
	public static function __callStatic($method, $args)
	{
		$instance = static::instance()->getNotifications();

		return call_user_func_array([$instance, $method], $args);
	}

}