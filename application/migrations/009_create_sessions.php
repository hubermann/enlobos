<?php defined('BASEPATH') OR exit('No direct script access allowed');  
 
class Migration_Create_Sessions extends CI_Migration
{
    public function up()
    {
        //TABLA 
        $this->dbforge->add_field(
            array(
                "id"        =>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        =>        40,
 
                ),
					"ip_address"    		=>        array(
                    "type"                =>        "VARCHAR",
                    "constraint"        	=>        45,
                ),
	
					"timestamp"    		=>        array(
                    "type"                =>        "INT",
                    "constraint"        	=>        10,
                ),
	
					"data"    		=>        array(
                    "type"                =>        "BLOB",
                    "unique"            =>        TRUE,
                    "primary"    =>        TRUE,
                ),
	
            )
        );

        $this->dbforge->create_table('ci_sessions');//crea la tabla
    }
 
    public function down()
    {
        $this->dbforge->drop_table('ci_sessions');
 
    }
}
?>