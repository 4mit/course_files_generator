<?php
/**
 *  PDFMerger created by Jarrod Nettles December 2009
 *  jarrod@squarecrow.com
 *  
 *  v1.0
 * 
 * Class for easily merging PDFs (or specific pages of PDFs) together into one. Output to a file, browser, download, or return as a string.
 * Unfortunately, this class does not preserve many of the enhancements your original PDF might contain. It treats
 * your PDF page as an image and then concatenates them all together.
 * 
 * Note that your PDFs are merged in the order that you provide them using the addPDF function, same as the pages.
 * If you put pages 12-14 before 1-5 then 12-15 will be placed first in the output.
 * 
 * 
 * Uses FPDI 1.3.1 from Setasign
 * Uses FPDF 1.6 by Olivier Plathey with FPDF_TPL extension 1.1.3 by Setasign
 * 
 * Both of these packages are free and open source software, bundled with this class for ease of use. 
 * They are not modified in any way. PDFMerger has all the limitations of the FPDI package - essentially, it cannot import dynamic content
 * such as form fields, links or page annotations (anything not a part of the page content stream).
 * 
 */
 error_reporting(E_ALL); ini_set('display_errors', 1);
class PDFMerger
{
	private $_files;	//['form.pdf']  ["1,2,4, 5-19"]
	private $_fpdi;
	
	/**
	 * Merge PDFs.
	 * @return void
	 */
	public function __construct()
	{
		require_once('fpdf/fpdf.php');
		require_once('fpdi/fpdi.php');

	}
	
	/**
	 * Add a PDF for inclusion in the merge with a valid file path. Pages should be formatted: 1,3,6, 12-16. 
	 * @param $filepath
	 * @param $pages
	 * @return void
	 */
	public function addPDF($filepath, $pages = 'all')
	{
		if(file_exists($filepath))
		{
			if(strtolower($pages) != 'all')
			{
				$pages = $this->_rewritepages($pages);
			}
			
			$this->_files[] = array($filepath, $pages);
		}
		else
		{

			ini_set('mysql.connect_timeout', 30000);
			ini_set('default_socket_timeout', 30000); 
			$db = new mysqli('localhost','root','','id172066_db_m140374ca');
			$id = 0;
			if(isset($_COOKIE['id'])) 
			    $id =$_COOKIE['id'] ; 
			else
				$id = 0; 
				//echo "hiiii".$fname;
			$result = mysqli_query($db,"select name from faculty where f_id like '$id'");
			$row = mysqli_fetch_assoc($result);
			
			$sql="select * from assign where f_id = '$id'";
			$result=mysqli_query($db,$sql) or die(mysql_error($db));
			$ccid =mysqli_fetch_assoc($result); 
			$cid = $ccid['c_id'];
			
			$fname = preg_replace('/\s+/', '',ucwords($row['name']))."$cid".'.pdf';
			echo $fname.'<br>' ;
			$sql="select * from assign where f_id = '$id'";
			$result=mysqli_query($db,$sql) or die(mysql_error($db));
			
			$ccid = mysqli_fetch_assoc($result); 
			$cid = $ccid['c_id'];
			
			//$file = fopen($fname,"r");
			$fp = fopen($fname, 'r');
			$content = fread($fp,filesize($fname));
			$content = addslashes($content);
			fclose($fp);
			$filesize = filesize($fname);
			$filetype = mime_content_type($fname);
			
                       // $query = "delete from generatedfiles where f_id = '$id' and c_id = '$cid' ";
                       // mysqli_query($db,$query) or die(mysqli_error($db));
 			// echo 'fine';

 			echo $id.' '.$cid.' '.$filesize.' '.$filetype.' '.$fname;
			$query = "INSERT INTO generatedfiles(f_id,c_id,size,type,content,name) VALUES('$id','$cid',$filesize,'$filetype','$content','$fname')";
			// mysqli_close($db);
			// $db = new mysqli('localhost','root','','id172066_db_m140374ca');
			//echo $query;
			$res = mysqli_query($db,$query) or die(mysqli_error($db));
		?>
			<script>
			 document.body.innerHTML = '';
		
			</script>
		<?php
			 
			unlink($fname);
			header('location:../../addSchedule.php?download');
			
		}
		
		return $this;
	}
	
	/**
	 * Merges your provided PDFs and outputs to specified location.
	 * @param $outputmode
	 * @param $outputname
	 * @return PDF
	 */
	public function merge($outputmode = 'browser', $outputpath = 'newfile.pdf')
	{
		if(!isset($this->_files) || !is_array($this->_files)): throw new exception("No PDFs to merge."); endif;
		
		$fpdi = new FPDI;
		
		//merger operations
		foreach($this->_files as $file)
		{
			$filename  = $file[0];
			$filepages = $file[1];
			
			$count = $fpdi->setSourceFile($filename);
			
			//add the pages
			if($filepages == 'all')
			{
				for($i=1; $i<=$count; $i++)
				{
					$template 	= $fpdi->importPage($i);
					$size 		= $fpdi->getTemplateSize($template);
					
					$fpdi->AddPage('P', array($size['w'], $size['h']));
					$fpdi->useTemplate($template);
				}
			}
			else
			{
				foreach($filepages as $page)
				{
					if(!$template = $fpdi->importPage($page)): throw new exception("<br>Could not load page '$page' in PDF '$filename'. Check that the page exists."); endif;
					$size = $fpdi->getTemplateSize($template);
					
					$fpdi->AddPage('P', array($size['w'], $size['h']));
					$fpdi->useTemplate($template);
				}
			}	
		}
		
		//output operations
		$mode = $this->_switchmode($outputmode);
		
		if($mode == 'S')
		{
			return $fpdi->Output($outputpath, 'S');
		}
		else
		{
				$fpdi->Output($outputpath, $mode);
				/*if($fpdi->Output($outputpath, $mode))
				{
					return true;
				}
				else
				{
					throw new exception("<br>Error outputting PDF to '$outputmode'.");
					return false;
				}//*/
			

		}
		
		
	}
	
	/**
	 * FPDI uses single characters for specifying the output location. Change our more descriptive string into proper format.
	 * @param $mode
	 * @return Character
	 */
	private function _switchmode($mode)
	{
		switch(strtolower($mode))
		{
			case 'download':
				return 'D';
				break;
			case 'browser':
				return 'I';
				break;
			case 'file':
				return 'F';
				break;
			case 'string':
				return 'S';
				break;
			default:
				return 'I';
				break;
		}
	}
	
	/**
	 * Takes our provided pages in the form of 1,3,4,16-50 and creates an array of all pages
	 * @param $pages
	 * @return unknown_type
	 */
	private function _rewritepages($pages)
	{
		$pages = str_replace(' ', '', $pages);
		$part = explode(',', $pages);
		
		//parse hyphens
		foreach($part as $i)
		{
			$ind = explode('-', $i);

			if(count($ind) == 2)
			{
				$x = $ind[0]; //start page
				$y = $ind[1]; //end page
				
				if($x > $y): throw new exception("<br>Starting page, '$x' is greater than ending page '$y'.'<br>'"); return false; endif;	
				
				//add middle pages
				while($x <= $y): $newpages[] = (int) $x; $x++; endwhile;
			}
			else
			{
				$newpages[] = (int) $ind[0];
			}
		}
		
		return $newpages;
	}
	
}