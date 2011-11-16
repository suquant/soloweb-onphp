<?php
/**
 * Created by JetBrains PhpStorm.
 * User: georgy
 * Date: 25.08.11
 * Time: 15:48
 * To change this template use File | Settings | File Templates.
 */
 
	class CtppView extends JsonView
	{

		const HEADER_NAME			= 'X-Template';

		const CEXTENSION			= 'ct2';

		/**
		 * @return CtppView
		 */
		public static function create()
		{
			return new self();
		}

		/**
		 * @return void
		 */
		protected function sendHeader()
		{
			$encoding = mb_get_info('internal_encoding');
			header('Content-Type: text/javascript; charset='.$encoding);

			return /* void */;
		}

	}