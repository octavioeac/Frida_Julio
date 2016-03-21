<?php
	
	class SistemaFridaBean
	{
		private $sclliEdificio;
		private $sclliSsistema;
		private $scorreoUsuario;
		private $sddSold;
		private $sfuncionEquipo;
		private $snombreOficial;
		private $sproveedorEquipo;
		private $stipoEquipo;
		private $stopologiaEquipo;
		private $subicacionEquipo;
		
		public function __construct($sclliEdificio, $sclliSsistema, $scorreoUsuario, $sddSold, $sfuncionEquipo, $snombreOficial, $sproveedorEquipo, $stipoEquipo, $stopologiaEquipo, $subicacionEquipo)
		{
			$this->sclliEdificio = $sclliEdificio;
			$this->sclliSistema = $sclliSsistema;
			$this->scorreoUsuario = $scorreoUsuario;
			$this->sddSold = $sddSold;
			$this->sfuncionEquipo = $sfuncionEquipo;
			$this->snombreOficial = $snombreOficial;
			$this->sproveedorEquipo = $sproveedorEquipo;
			$this->stipoEquipo = $stipoEquipo;
			$this->stopologiaEquipo = $stopologiaEquipo;
			$this->subicacionEquipo = $subicacionEquipo;
		}
		
		//*********
		public function getSclliEdificio() {
			return $this->sclliEdificio;
		}
		
		public function setSclliEdificio( $sclliEdificio ) {
			$this->sclliEdificio = $sclliEdificio;
		}
		
		//*********
		public function getSclliSsistema() {
			return $this->sclliSistema;
		}
		
		public function setSclliSsistema( $sclliSsistema ) {
			$this->sclliSistema = $sclliSsistema;
		}
		
		//*********
		public function getScorreoUsuario() {
			return $this->scorreoUsuario;
		}
		
		public function setScorreoUsuario( $scorreoUsuario ) {
			$this->scorreoUsuario = $scorreoUsuario;
		}
		
		//*********
		public function getSddSold() {
			return $this->sddSold;
		}
		
		public function setSddSold( $sddSold ) {
			$this->sddSold = $sddSold;
		}
		
		//*********
		public function getSfuncionEquipo() {
			return $this->sfuncionEquipo;
		}
		
		public function setSfuncionEquipo( $sfuncionEquipo ) {
			$this->sfuncionEquipo = $sfuncionEquipo;
		}
		
		//*********
		public function getSnombreOficial() {
			return $this->snombreOficial;
		}
		
		public function setSnombreOficial( $snombreOficial ) {
			$this->snombreOficial = $snombreOficial;
		}
		
		//*********
		public function getSproveedorEquipo() {
			return $this->sproveedorEquipo;
		}
		
		public function setSproveedorEquipo( $sproveedorEquipo ) {
			$this->sproveedorEquipo = $sproveedorEquipo;
		}
		
		//*********
		public function getStipoEquipo() {
			return $this->stipoEquipo;
		}
		
		public function setStipoEquipo( $stipoEquipo ) {
			$this->stipoEquipo = $stipoEquipo;
		}
		
		//*********
		public function getStopologiaEquipo() {
			return $this->stopologiaEquipo;
		}
		
		public function setStopologiaEquipo( $stopologiaEquipo ) {
			$this->stopologiaEquipo = $stopologiaEquipo;
		}
		
		//*********
		public function getSubicacionEquipo() {
			return $this->subicacionEquipo;
		}
		
		public function setSubicacionEquipo( $subicacionEquipo ) {
			$this->subicacionEquipo = $subicacionEquipo;
		}
		
	}
	
?>
