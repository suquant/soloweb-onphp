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
 
	class JsonPView extends JsonView
	{
		/**
		 * Название функции в которую оборачиваем json
		 * @var string
		 */
		protected $callback			= null;
		
		/**
		 * @param IJsonable $subject
		 * @return JsonPView
		 */
		public static function create()
		{
			return new self();
		}
		
		
		/**
		 * @param string $callback
		 * @return JsonPView
		 */
		public function setCallback($callback)
		{
			$this->callback = $callback;
			
			return $this;
		}

		/**
		 * @param Model|null $model
		 * @return string
		 */
		protected function makeRender(Model $model = null)
		{
			$parent = parent::makeRender($model);
			$out =  $this->callback.'('.$parent.');';

			return $out;
		}
		
	} 