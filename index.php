<?php
date_default_timezone_set('utc');
include "es_AR.php";
class Usuario {
	protected $nombre;
	protected $clave;
	protected $edad;
	protected $favoritos = array();

	public function __construct($nombre, $clave, $edad) {
		$this->nombre = $nombre;
		$this->clave = $clave;
		$this->edad = $edad;
		$this->validar();
	}
	public function validar() {
		$errores = array();
		if(!isset($this->usuario) ||
			is_null($this->usuario) ||
			strlen($this->usuario) < 1
		) {
			$errores[] = $i18n['user_name_cant_be_empty'];
		}
		if($this->edad < 18) {
			$errores[] = $i18n['user_age_must_be_18+'];
		}
		return $errores;
	}
	public function agregarFavorito(Usuario $favorito) {
		$this->favoritos[] = $favorito;
	}
	public function removerFavorito(Usuario $favorito) {
		$key = $this->buscarEnFavoritos($favorito);
		if($key !== FALSE) {
			unset($this->favoritos[$key]);
		}
	}
	public function buscarEnFavoritos($strict = TRUE) {
		return array_search($favorito, $this->favoritos, $strict);
	}
	public function getFavoritos() {
		return $this->favoritos;
	}
}
class Pago {
	protected $usuario;
	protected $importe;
	protected $fecha;
	public function __construct(Usuario $usuario, $importe, $fecha) {
		$this->usuario = $usuario;
		$this->importe = $importe;
		$this->fecha = DateTime::createFromFormat('Y-m-d', $fecha);
	}
	public function validar() {
		$errores = array();
		if ($this->importe <= 0) {
			$errores[] = $i18n['payment_ammount_must_be_positive'];
		}
		if ($this->fecha < new DateTime('now')) {
			$errores[] = $i18n['payment_date_cant_be_past'];
		}
		return $errores;
	}
}