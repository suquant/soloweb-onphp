<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1 at 2010-03-24 21:11:41                           *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoTestContactValue extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'email' => LightMetaProperty::fill(new LightMetaProperty(), 'email', null, 'string', null, 255, true, true, false, null, null),
				'icq' => LightMetaProperty::fill(new LightMetaProperty(), 'icq', null, 'integer', null, 4, false, true, false, null, null),
				'phone' => LightMetaProperty::fill(new LightMetaProperty(), 'phone', null, 'string', null, 255, true, true, false, null, null),
				'city' => LightMetaProperty::fill(new LightMetaProperty(), 'city', 'city_id', 'integerIdentifier', 'TestCity', null, true, false, false, 1, 3)
			);
		}
	}
?>