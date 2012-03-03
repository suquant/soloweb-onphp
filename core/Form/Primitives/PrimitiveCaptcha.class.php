<?php
/***************************************************************************
 *   Copyright (C) 2010 by Kutcurua Georgy Tamazievich                     *
 *   email: g.kutcurua@gmail.com, icq: 723737, jabber: soloweb@jabber.ru   *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU Lesser General Public License as        *
 *   published by the Free Software Foundation; either version 3 of the    *
 *   License, or (at your option) any later version.                       *
 *                                                                         *
 ***************************************************************************/
/* $Id$ */

	class PrimitiveCaptcha extends PrimitiveString  {

		const DEFAULT_LABEL						= 'captcha_key';
		
		protected $captchaSessionLabel			= self::DEFAULT_LABEL;
		
		/**
		 * Captcha
		 *
		 * @param String $name
		 * @return PrimitiveCaptcha
		 */
		public static function create($name) {
			return new self($name);
		}
		
		/**
		 * Проверяем капчу
		 *
		 */
		protected function checkConstrain() {
			
			$key = Session::get('securimage_code_value');

			if( isset( $key[$this->captchaSessionLabel] ) )
				$key = (string) $key[$this->captchaSessionLabel];
			
			if( is_null($key) )
				$this->setError(self::WRONG);
				
			if(
				mb_strtolower( $key ) != mb_strtolower( $this->value )
			)
				$this->setError(self::WRONG);
		}
		
		/**
		 * Сбрасываем капчу
		 */
		protected function resetCpatcha()
		{
			Session::drop($this->captchaSessionLabel);
		}
		
		/**
		 * @param String $value
		 * @return PrimitiveCaptcha
		 */
		public function setCaptchaSessionLabel($value) {
			$this->captchaSessionLabel = $value;
			
			return $this;
		}
		
		public function import(array $scope) {
			if (
				!($result = parent::import($scope))
			)
				return $result;
			
			
			
			if( $this->isImported() )
			{
				$this->checkConstrain();
				$this->resetCpatcha();
			}
			
			
			if (!$this->getError()) {
				return true;
			} else {
				$this->value = null;
			}
			
			return false;
		}

	}

?>