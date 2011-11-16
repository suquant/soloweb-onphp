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
 
	class JsonXssView extends JsonView
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
			$out = parent::makeRender($model);

			$result= '<script type="text/javascript">'."\n";

			$result.= 'window.'.$this->callback.'=\''.$out.'\';'."\n";
			//echo 'console.log(window.'.$this->callback.')'."\n";


			//echo 'alert( eval("("+window.'.$this->callback.'+").fedor") );'."\n";

			$result.= '</script>'."\n";

			return $result;
		}

		/**
		 * @return void
		 */
		protected function headerContentType()
		{
			$encoding = mb_get_info('internal_encoding');
			header('Content-Type: text/html; charset='.$encoding);

			return /* void */;
		}

		
		protected function encode($data)
		{
			$json = parent::encode($data);
			
			$json = preg_replace('/u0022/', '\u0022', $json);
			$json = preg_replace('/u0027/', '\u0027', $json);
			//$json = preg_replace('/"/', '\"', $json);
			//$json = preg_replace("/'/", "\'", $json);
			
			
			return $json; 
		}
		
	} 