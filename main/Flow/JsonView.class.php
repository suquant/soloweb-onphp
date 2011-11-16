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
 
	class JsonView implements View
	{
		/**
		 * @param IJsonable $subject
		 * @return JsonView
		 */
		public static function create()
		{
			return new self();
		}


		/**
		 * @return void
		 */
		protected function headerContentType()
		{
			$encoding = mb_get_info('internal_encoding');
			header('Content-Type: text/javascript; charset='.$encoding);

			return /* void */;
		}

		/**
		 * @param $output
		 * @return void
		 */
		protected function headerContentLength($output)
		{
			header('Content-Length: '.mb_strlen($output) );

			return /* void */;
		}

		/**
		 * @param $output
		 * @return void
		 */
		protected function header($output)
		{
			$this->headerContentType();
			//$this->headerContentLength($output);

			return /* void */;
		}


		/**
		 * @param Model|null $model
		 * @return string
		 */
		protected function makeRender(Model $model = null)
		{
			$data = array();

			if(
				$model &&
				!$model->isEmpty()
			){
				$data = array_merge(
					$data,
					//$model->getList()
					$this->makeArray($model->getList() )
				);

			}

			$output = $this->encode($data);

			return $output;
		}
		
		/** (non-PHPdoc)
		 * @see main/Flow/View::render()
		 * @return void
		 */
		public function render(Model $model = null)
		{

			$output = $this->makeRender($model);

			/*
			error_log(
				'mb_strlen: '.mb_strlen( $output )."\n".
				'strlen: '.strlen( $output ) . "\n".
				'postfix: '.mb_substr($output, -5)
			);
			*/
			
			
			$this->header($output);

			echo $output;
				
			return /*void*/;
		}
		
		/**
		 * @param string $data
		 * @return string
		 */
		protected function encode($data)
		{
			return json_encode($data, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP);
			//return json_encode($data);
			
		}
		
		/**
		 * @param Model $model
		 * @return Ambigous <multitype:, IArrayable>
		 */
		protected function makeArray($array, $level=4)
		{
			
			$data = array();
			foreach ( $array as $key => $value )
			{
				if( $value instanceof IArrayable )
					$data[$key]= $this->makeArray($value->toArray(), --$level);
				elseif(
					is_array($value) &&
					$level > 0
				)
					$data[$key]=$this->makeArray($value, --$level);
				elseif (
					$value instanceof SimplifiedArrayAccess &&
					$level > 0
				)
					$data[$key]=$this->makeArray($value->getList(), --$level);
				elseif( is_scalar( $value ) )
				{
//					$data[$key] = preg_replace(
//						array(
//							'/"/i',
//							'/\'/i',
//						),
//						array(
//							'\\\u0022',
//							'\\\u0027',
//						),
//						$value
//					);
					$data[$key] = $value;
				}					
				else 
					$data[$key] = $value;
			}

			//var_dump($data);
			
			return $data;
		}
		
	} 