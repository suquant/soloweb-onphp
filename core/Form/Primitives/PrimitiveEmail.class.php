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

	class PrimitiveEmail extends PrimitiveString  {

		public function __construct($name) {
			parent::__construct($name);

			/**
			 * Проверяем на ввод правельного email адресса
			 */
			$this->setAllowedPattern(self::MAIL_PATTERN);
		}

		/**
		 * Email
		 *
		 * @param String $name
		 * @return PrimitiveEmail
		 */
		public static function create($name) {
			return new self($name);
		}

	}


?>