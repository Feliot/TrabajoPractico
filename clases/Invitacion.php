<?php
class Invitacion
{
	public $id;
 	public $DNI;
  	public $nombre;
  	public $apellido;

  	public function BorrarInvitacion()
	 {
	 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from Invitaciones 				
				WHERE id=:id");	
				$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();
	 }

	public static function BorrarInvitacionPorApellido($apellido)
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from Invitaciones 				
				WHERE apellido=:Apellido");	
				$consulta->bindValue(':Apellido',$apellido, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();

	 }
	public function ModificarInvitacion()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update Invitaciones 
				set DNI='$this->DNI',
				nombre='$this->nombre',
				apellido='$this->apellido'
				WHERE id='$this->id'");
			return $consulta->execute();

	 }
	
  
	 public function InsertarElInvitacion()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into Invitaciones (DNI,nombre,apellido)values('$this->DNI','$this->nombre','$this->apellido')");
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
				

	 }

	  public function ModificarInvitacionParametros()
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update Invitaciones 
				set DNI=:DNI,
				nombre=:Nombre,
				apellido=:Apellido
				WHERE id=:id");
			$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
			$consulta->bindValue(':DNI',$this->DNI, PDO::PARAM_INT);
			$consulta->bindValue(':Apellido', $this->apellido, PDO::PARAM_STR);
			$consulta->bindValue(':Nombre', $this->nombre, PDO::PARAM_STR);
			return $consulta->execute();
	 }

	 public function InsertarElInvitacionParametros()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into Invitaciones (DNI,nombre,apellido)values(:DNI,:Nombre,:Apellido)");
				$consulta->bindValue(':DNI',$this->DNI, PDO::PARAM_INT);
				$consulta->bindValue(':Apellido', $this->apellido, PDO::PARAM_STR);
				$consulta->bindValue(':Nombre', $this->nombre, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }
	 public function GuardarInvitacion()
	 {

	 	if($this->id>0)
	 		{
	 			$this->ModificarInvitacionParametros();
	 		}else {
	 			$this->InsertarElInvitacionParametros();
	 		}

	 }


  	public static function TraerTodoLasInvitaciones()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id,DNI as DNI, nombre as nombre,apellido as apellido from Invitaciones");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "Invitacion");		
	}

	public static function TraerUnInvitacion($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, DNI as DNI, nombre as nombre,apellido as apellido from Invitaciones where id = $id");
			$consulta->execute();
			$InvitacionBuscado= $consulta->fetchObject('Invitacion');
			return $InvitacionBuscado;				

			
	}

	public static function TraerUnInvitacionApellido($id,$Apellido) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  DNI as DNI, nombre as nombre,apellido as apellido from Invitaciones  WHERE id=? AND apellido=?");
			$consulta->execute(array($id, $Apellido));
			$InvitacionBuscado= $consulta->fetchObject('Invitacion');
      		return $InvitacionBuscado;				

			
	}

	public static function TraerUnInvitacionApellidoParamNombre($id,$Apellido) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  DNI as DNI, nombre as nombre,apellido as apellido from Invitaciones  WHERE id=:id AND apellido=:Apellido");
			$consulta->bindValue(':id', $id, PDO::PARAM_INT);
			$consulta->bindValue(':Apellido', $Apellido, PDO::PARAM_STR);
			$consulta->execute();
			$InvitacionBuscado= $consulta->fetchObject('Invitacion');
      		return $InvitacionBuscado;				

			
	}
	
	public static function TraerUnInvitacionApellidoParamNombreArray($id,$Apellido) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  DNI as DNI, nombre as nombre,apellido as apellido from Invitaciones  WHERE id=:id AND apellido=:Apellido");
			$consulta->execute(array(':id'=> $id,':Apellido'=> $Apellido));
			$consulta->execute();
			$InvitacionBuscado= $consulta->fetchObject('Invitacion');
      		return $InvitacionBuscado;				

			
	}
    
    public static function TraerEstadisticas() 
    {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select count(*) as CantidadInvitacion, nombre as nombre from Invitaciones group by nombre order by CantidadInvitacion desc limit 5");
			$consulta->execute();
      		return $consulta->fetchAll();		
    }

	public function mostrarDatos()
	{
	  	return "Metodo mostar:".$this->DNI."  ".$this->nombre."  ".$this->apellido;
	}

}