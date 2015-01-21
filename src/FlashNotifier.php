<?php namespace Cartalyst\Alerts;
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

use Cartalyst\Alerts\Storage\StorageInterface;

class FlashNotifier extends Notifier {

	/**
	 * Session instance.
	 *
	 * @var \Illuminate\Session\Store
	 */
	protected $session;

	/**
	 * Constructor.
	 *
	 * @param  array  $config
	 * @param  \Cartalyst\Alerts\Storage\StorageInterface  $session
	 * @return void
	 */
	public function __construct(array $config = [], StorageInterface $session)
	{
		parent::__construct($config);

		$this->session = $session;
	}

	/**
	 * {@inheritDoc}
	 */
	public function alert($messages, $type, $area = 'default', $isFlash = true, $extra = null)
	{
		parent::alert($messages, $type, $area, $isFlash, $extra);

		$this->commit();
	}

	/**
	 * {@inheritDoc}
	 */
	public function all()
	{
		return $this->session->get('cartalyst.alerts', []) ?: [];
	}

	/**
	 * {@inheritDoc}
	 */
	protected function commit()
	{
		$this->session->flash('cartalyst.alerts', $this->alerts);
	}

}
