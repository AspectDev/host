<?php 
	class Functions{
		/*
			Функция проверки на валидность email.
			Возвращает true в случае если $string похож на email
			Возвращает false в случае если $string не похож на email
		*/
		public function CheckValidationEmail($string){
			return filter_var(strtolower($string), FILTER_VALIDATE_EMAIL);
		}
		/*
			Функция проверки на валидность IP-адреса.
			Возвращает true в случае если $string похож на IP-адрес
			Возвращает false в случае если $string не похож на IP-адрес
		*/
		public function CheckValidationIP($string){
			return filter_var($string, FILTER_VALIDATE_IP);
		}
	}
?>