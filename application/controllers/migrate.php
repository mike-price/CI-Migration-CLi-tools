<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migrate extends CI_Controller {

	public function version($version=null)
	{
		echo "starting";
		// check CLI
		if ($this->input->is_cli_request()) 
		{
			// load lib
			$this->load->library('migration');
			// are we current?
			
			if(is_null($version))
			{
				if (!$this->migration->current())
				{
					echo $this->migration->error_string();
				}
				
				echo "Updated to the latest version \n";
			}
			else
			{
				$this->migration->version($version);
				
				echo "Updated to version $version \n";
			}
		}
		else
		{
			echo "Permission denied \n";
		}
		
		echo "end";
	}
	
	public function test()
	{
		echo "test";
	}

}

?>