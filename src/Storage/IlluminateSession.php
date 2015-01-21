<?php namespace Cartalyst\Alerts\Storage;
/**
 * Part of the Alerts package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Alerts
 * @version    1.0.0
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011-2014, Cartalyst LLC
 * @link       http://cartalyst.com
 */

use Illuminate\Session\Store as SessionStore;

class IlluminateSession implements StorageInterface {

	/**
	 * Session store object.
	 *
	 * @var \Illuminate\Session\Store
	 */
	protected $session;

	/**
	 * Creates a new Illuminate based Session driver for Alerts.
	 *
	 * @param  \Illuminate\Session\Store  $session
	 * @param  string  $key
	 * @return void
	 */
	public function __construct(SessionStore $session)
	{
		$this->session = $session;
	}

	/**
	 * {@inheritDoc}
	 */
	public function get($key)
	{
		return $this->session->get($key);
	}

	/**
	 * {@inheritDoc}
	 */
	public function flash($key, $value)
	{
		return $this->session->flash($key, $value);
	}

}
