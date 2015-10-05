<?php defined('BASEPATH') OR exit('No direct script access allowed');  
 
class Migration_Create_Eventos extends CI_Migration
{
    public function up()
    {
        //TABLA 
        $this->dbforge->add_field(
            array(
                "id"        =>        array(
                    "type"                =>        "INT",
                    "constraint"        =>        11,
                    "unsigned"            =>        TRUE,
                    "auto_increment"    =>        TRUE,
 
                ),
					"categoria_id"    		=>        array(
                    "type"                =>        "INT",
                    "constraint"        	=>        11,
                ),
	
					"titulo"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"            =>        255,
                ),
	
					"slug"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"            =>        255,
                ),
	
					"destacado"    		=>        array(
                    "type"                =>        "INT",
                    "constraint"        	=>        1,
                ),
	
					"descripcion"    		=>        array(
                    "type"                =>        "TEXT",

                ),
	
					"fecha_desde"    		=>        array(
                    "type"                =>        "DATE",

                ),
	
					"fecha_hasta"    		=>        array(
                    "type"                =>        "DATE",

                ),
	
					"horario"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"            =>        100,
                ),
	
					"organizador"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"            =>        100,
                ),
	
					"direccion"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        100,
                ),
	
					"costo"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"            =>        80,
                ),
	
					"mapa"    		=>        array(
                    "type"                =>        "TEXT",
                ),
	
					"filename"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"            =>        255,
                ),
	
            )
        );
 
        $this->dbforge->add_key('id', TRUE); //ID como primary_key
        $this->dbforge->create_table('eventos');//crea la tabla
    }
 
    public function down()
    {
        //ELIMINAR TABLA
        $this->dbforge->drop_table('eventos');
 
    }
}
?>