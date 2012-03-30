<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/* *
 * 
 * CodeIgniter Migration CLI Controller
 * Author: Mike Price, @web_mech
 * Author: Jd Fiscus, @iamfiscus 
 * 
 * */
class Migrate extends CI_Controller {
	
	public function __contruct(){
		parent::__construct();
		// check CLI
		if ($this->input->is_cli_request()) 
		{
			echo "Permission denied \n";
			exit;
		}
	}
	
	
	public function version($version=null)
	{
		
		$this->load->library('migration');
		
		if(is_null($version))
		{
			if (!$this->migration->current())
			{
				show_error($this->migration->error_string());
				return;
			}
			
			echo "Updated to the latest version \n";
		}
		else
		{
			$this->migration->version($version);
			
			echo "Updated to version $version \n";
		}
	}
	
	
	public function create($name)
	{
		$this->load->helper('file');
		
$data = "<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_".ucwords($name)." extends CI_Migration {

	public function up()
	{
		
	}

	public function down()
	{
		
	}
	
}";
		$directory = APPPATH."migrations/";
		$count = (glob($directory . "*.php") != false) ? count(glob($directory . "*.php")) + 1 : 1;
		$file = str_pad($count, 3, '0', STR_PAD_LEFT)."_$name";
		
		if (!write_file($directory."$file.php", $data))
		{
		     echo "Unable to write the migration file\n";
		}
		else
		{
		     echo "Migration file written!\n";
		}
	}
}

?>