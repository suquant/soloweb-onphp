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
 
	final class CallerExpression implements LogicalObject {
		
		/*
		 * Поля из формы
		 */
		protected $fields		= array();
		
		/**
		 * @var array | function
		 */
		private $function		= null;
		
		
		/**
		 * @param String $name
		 * @return CallerExpression
		 */
		public static function create($field) {
			return new self($field);
		}
		
		public function __construct($field) {
			$this->add($field);
		}
		
		/**
		 * @param mixed $field
		 * @return CallerExpression
		 */
		public function add($field)
		{
			array_push(	$this->fields, $field );
			return $this;
		}
		
		/**
		 * @param array | function $function
		 * @return CallerExpression
		 */
		public function setFunction($function) {
			$this->function = $function;
			
			return $this;
		}
		
		
		/** (non-PHPdoc)
		 * @see core/Logic/LogicalObject::toBoolean()
		 * @return boolean
		 */
		public function toBoolean(Form $form) {
			try{
				
				$params = array();
				foreach ( $this->fields as $field )
				{
					$value = null;
					if( $field instanceof FormField )
						$value = $field->toValue($form);
					else
						$value = $form->getValue( $field);
						
					array_push($params, $value);
				}
				
				$result = (boolean)
					call_user_func_array(
						$this->function,
						$params
					);
					
				return $result;
			} 
			catch (ObjectNotFoundException $e) {/**/}
			catch (Exception $e){
				error_log(
					__METHOD__.': '.
					$e->__toString()
				);
				throw $e;
			}
			
			return false;
		}
		
		/** (non-PHPdoc)
		 * @see core/OSQL/DialectString::toDialectString()
		 */
		public function toDialectString(Dialect $dialect) {
			throw new UnsupportedMethodException();
		}
	}