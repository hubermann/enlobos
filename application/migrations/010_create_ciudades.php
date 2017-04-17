<?php defined('BASEPATH') OR exit('No direct script access allowed');  
 
class Migration_Create_Ciudades extends CI_Migration
{
    public function up()
    {
        //TABLA 
        $this->dbforge->add_field(
            array(
                "id_ciudad"        =>        array(
                    "type"                =>        "INT",
                    "constraint"        =>        11,
                    "unsigned"            =>        TRUE,
                    "auto_increment"    =>        TRUE,
 
                ),
                "id_provincia"        =>        array(
                    "type"                =>        "INT",
                    "constraint"        =>        11,
 
                ),
					"nombre_ciudad"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        80,
                ),
					"filename"    		=>        array(
                    "type"                =>        "TEXT",
                    "constraint"        	=>        100,
                ),
	
            )
        );
 
        $this->dbforge->add_key('id_ciudad', TRUE); //ID como primary_key
        $this->dbforge->create_table('ciudades');//crea la tabla
    }
 
    public function down()
    {
        //ELIMINAR TABLA
        $this->dbforge->drop_table('ciudades');
 
    }
}
?>