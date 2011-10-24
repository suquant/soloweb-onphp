<?php
/***************************************************************************
 *   Copyright (C) 2007 by Anton E. Lebedevich                             *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU Lesser General Public License as        *
 *   published by the Free Software Foundation; either version 3 of the    *
 *   License, or (at your option) any later version.                       *
 *                                                                         *
 ***************************************************************************/

	/**
	 * @ingroup Http
	**/
	final class HttpMethod extends Enumeration
	{
		const OPTIONS	= 1;
		const GET		= 2;
		const HEAD 		= 3;
		const POST		= 4;
		const PUT		= 5;
		const DELETE	= 6;
		const TRACE		= 7;
		const CONNECT	= 8;
		const MKCOL		= 9;
		const COPY		= 10;
		const MOVE		= 11;
		
		
		protected $names = array(
			self::OPTIONS 	=> 'OPTIONS',
			self::GET		=> 'GET',
			self::HEAD		=> 'HEAD',
			self::POST		=> 'POST',
			self::PUT		=> 'PUT',
			self::DELETE	=> 'DELETE',
			self::TRACE 	=> 'TRACE',
			self::CONNECT 	=> 'CONNECT',
			self::MKCOL		=> 'MKCOL',
			self::COPY		=> 'COPY',
			self::MOVE		=> 'MOVE',
		);
		
		/**
		 * @return HttpMethod
		 */
		public static function get()
		{
			return new self(self::GET);
		}
		
		/**
		 * @return HttpMethod
		 */
		public static function post()
		{
			return new self(self::POST);
		}
		
		/**
		 * @return HttpMethod
		 */
		public static function put()
		{
			return new self(self::PUT);
		}
		
		/**
		 * @return HttpMethod
		 */
		public static function head()
		{
			return new self(self::HEAD);
		}
		
		/**
		 * @return HttpMethod
		 */
		public static function options()
		{
			return new self(self::OPTIONS);
		}
		
		/**
		 * @return HttpMethod
		 */
		public static function delete()
		{
			return new self(self::DELETE);
		}
		
		/**
		 * @return HttpMethod
		 */
		public static function trace()
		{
			return new self(self::TRACE);
		}
		
		/**
		 * @return HttpMethod
		 */
		public static function connect()
		{
			return new self(self::CONNECT);
		}
		
		/**
		 * WebDAV create collections method
		 * @see http://www.ietf.org/rfc/rfc4918.txt
		 * @return HttpMethod
		 */
		public static function mkcol()
		{
			return new self(self::MKCOL);
		}
		
		/**
		 * WebDAV create collections method
		 * @see http://www.ietf.org/rfc/rfc4918.txt
		 * @return HttpMethod
		 */
		public static function copy()
		{
			return new self(self::COPY);
		}
		
		/**
		 * WebDAV create collections method
		 * @see http://www.ietf.org/rfc/rfc4918.txt
		 * @return HttpMethod
		 */
		public static function move()
		{
			return new self(self::MOVE);
		}
		
	}
?>