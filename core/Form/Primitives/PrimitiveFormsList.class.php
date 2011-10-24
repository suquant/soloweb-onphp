<?php
/***************************************************************************
 *   Copyright (C) 2007-2008 by Ivan Y. Khvostishkov                       *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU Lesser General Public License as        *
 *   published by the Free Software Foundation; either version 3 of the    *
 *   License, or (at your option) any later version.                       *
 *                                                                         *
 ***************************************************************************/

	/**
	 * @ingroup Primitives
	**/
	final class PrimitiveFormsList extends PrimitiveForm
	{
		protected $value = array();
		
		/**
		 * @return PrimitiveFormsList
		**/
		public function clean()
		{
			parent::clean();
			
			$this->value = array();
			
			return $this;
		}
		
		public function setComposite($composite = true)
		{
			throw new UnsupportedMethodException(
				'composition is not supported for lists'
			);
		}
		
		public function getInnerErrors()
		{
			$result = array();
			
			foreach ($this->getValue() as $id => $form) {
				if ($errors = $form->getInnerErrors())
					$result[$id] = $errors;
			}
			
			return $result;
		}
		
		public function import(array $scope)
		{
			if (!$this->proto)
				throw new WrongStateException(
					"no proto defined for PrimitiveFormsList '{$this->name}'"
				);
			
			if (!BasePrimitive::import($scope))
				return null;
			
			$list = $scope[$this->name];
			
			if (!is_array($list))
				return false;
			
			$error = false;
			
			$this->value = array();
			
			//$length = count($list);
			
			foreach ($list as $id => $value) {
				
				if(
					!$this->isRequired() &&
					(
						!$value ||
						!is_array($value)
					)
				){
					continue;
				}
				
				if( !is_array($value) )
					return false;
				
				$form = $this->makeForm();
				$form->clean();
				$form->import($value);
				
				if(
					!$this->isRequired() &&
					$form->getErrors()
				)
					continue;
				
				$this->value[$id] = $form;
							
				if ($form->getErrors())
					$error = true;
					
				$form = null;
			}
			
			return ( $error == false );
		}
		
		public function importValue($value)
		{
			if ($value !== null)
				Assert::isArray($value);
			else
				return null;
			
			$result = true;
			
			$resultValue = array();
			
			foreach ($value as $id => $form) {
				Assert::isInstance($form, 'Form');
				
				$resultValue[$id] = $form;
				
				if ($form->getErrors())
					$result = false;
			}
			
			$this->value = $resultValue;
			
			return $result;
		}
		
		public function exportValue()
		{
			if (!$this->isImported())
				return null;
			
			$result = array();
			
			foreach ($this->value as $id => $form) {
				$result[$id] = $form->export();
			}
			
			return $result;
		}
	}
?>