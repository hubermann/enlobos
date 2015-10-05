<?php defined('BASEPATH') OR exit('No direct script access allowed');  
 
class Migration_Create_Comercios extends CI_Migration
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
					"razon_social"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        180,
                ),
	
					"categoria_id"    		=>        array(
                    "type"                =>        "INT",
                    "constraint"        	=>        11,
                ),
	
					"slug"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"            =>        255,
                ),
	
					"direccion"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"            =>        180,
                ),
	
					"telefono"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"            =>        100,
                ),
	
					"telefono2"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"            =>        100,
                ),
	
					"email"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"            =>        120,
                ),
	
					"email2"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"            =>        120,
                ),
	
					"descripcion_corta"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"            =>        255,
                ),
	
					"descripcion"    		=>        array(
                    "type"                =>        "TEXT",

                ),
	
					"mapa"    		=>        array(
                    "type"                =>        "TEXT",
                ),
	
					"web"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"            =>        120,
                ),
	
					"facebook"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"            =>        120,
                ),
	
					"filename"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"            =>        255,
                ),
	
            )
        );
 
        $this->dbforge->add_key('id', TRUE); //ID como primary_key
        $this->dbforge->create_table('comercios');//crea la tabla
    }
 
    public function down()
    {
        //ELIMINAR TABLA
        $this->dbforge->drop_table('comercios');
 
    }
}
?>