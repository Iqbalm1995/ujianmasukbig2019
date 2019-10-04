<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Palindrome extends CI_Controller {

	public function index()
	{
		$this->load->view('no1/palindrome_view');
	}

	public function tambah_aksi()
	{
		$jmlInput = $_POST['jmlInput'];
		for ($i=1; $i <=$jmlInput; $i++) { 
			$inputArray[$i] = $_POST['huruf'.$i];
		}

		echo "<center>";
		echo "<h2>Output kata Palindrome</h2>";
		// $inputArray = array("p","h","o","b","i","a");
		echo "<b>input = </b>";
		for ($i=1; $i <= $jmlInput; $i++) { 
			echo $inputArray[$i];
		}
		echo "<hr />";
		echo "<b>output = </b>";
		for ($i=1; $i <= $jmlInput; $i++) { 
			echo $inputArray[$i];
		}
		for($i=$jmlInput - 1; $i >=1; $i--){
			echo $inputArray[$i];
		}
		echo '<br><br><br>';
		echo '<a href="'.base_url().'palindrome"><< Kembali<a>';
		echo "</center>";
	}

	public function no2()
	{
		$jumlah = 5;
 		for($a=1; $a<=$jumlah; $a++){
		    for($b=1; $b<=$a; $b++){
		        echo ' ';
		    }
		    for($c=$jumlah; $c>=$a; $c-=1){
		        echo '* ';
		    }
		    echo "<br>"; 
		}
		for($c=$jumlah; $c>=$a; $c-=1){
		    echo '* ';
		}
		for($a=1+1; $a<=$jumlah; $a++){
		    for($b=$jumlah; $b>=$a; $b-=1){
		        echo ' ';
		    }
		    for($c=1; $c<=$a; $c++){
		        echo '* ';
		    }
		    echo "<br>"; 
		}   
	}
}

/* End of file palindrome.php */
/* Location: ./application/controllers/palindrome.php */