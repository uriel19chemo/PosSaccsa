<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//zona horaria
date_default_timezone_set('America/Mexico_City');
//Clase control login  
class backup extends CI_Controller {
//constructor de la clase
	function __construct(){

		parent::__construct();

	}
//Funcion index 
	public function index(){
       
	}
        
//Funcion Backup para respaldo de la base de datos
        public function backupBD(){
        
        $this->load->dbutil();
        $prefs = array(
                'format'      => 'zip',
                'filename'    => 'backup'.date('d-m-Y').'.sql'
              );

        $backup =& $this->dbutil->backup($prefs);

        $this->load->helper('file');
        write_file(base_url().'backup/backup.zip', $backup);

        $this->load->helper('download');
        force_download('backup'.date('d-m-Y H:m:s').'.zip', $backup);
        
        }
        
}

