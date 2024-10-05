<?php
include_once "crudop/crud.php";
$crud = new Crud();

$qryCatg="select distinct catg1 from webdata2 where catg1!='' and catg1='Tenders'";
$resCatg=$crud->getData($qryCatg);
foreach($resCatg as $a=>$b)
{
	$qryFile="select * from webdata2 where file!='' and catg1='".$b['catg1']."'";
	$resFile=$crud->getData($qryFile);
	//print_r($resFile);
	//echo "<br>";
	foreach($resFile as $a1=>$b1)
	{
	
		echo $b1['path'];
		echo "<hr>";
			if (strpos($b1['path'], ',') !== false) {
				$mulpath=$b1['path'];
				$diff_files=explode(",",$mulpath);
				$i=1;

				foreach($diff_files as $a)
				{

					$url = $a;
					$path = parse_url($url, PHP_URL_PATH); 
					$dirname = substr($path, strpos($path, "/wp-content/") + strlen("/wp-content/"));
					
					echo $source="C:/".$dirname;
					echo "$$$$$$";
					 $file=basename($source);
					echo $dest=$b1['catg1']."/".$file;
					if($file!=""){
					if(copy($source,$dest))
						{

								$ext = pathinfo($file, PATHINFO_EXTENSION);
								echo $ext;

								echo "<br>";
								echo $b1['serial_number']."-".$i.".".$ext;
							echo "Multiple Copied".$i;
							$old=$dest;
							$new=$b1['catg1']."/".$b1['serial_number']."-".$i.".".$ext;

							rename($old,$new);

						}
						$i++;
					}
						
				}
				$sno=$b1['serial_number'];
				$catg=$b1['catg1'];
				$noItems=count($diff_files);
		$qryUpd=$crud->execute("update webdata2 set postType=$noItems where serial_number='$sno' and catg1='$catg'");

			}else
			{

					$url = $b1['path'];
					$path = parse_url($url, PHP_URL_PATH); 
					$dirname = substr($path, strpos($path, "/wp-content/") + strlen("/wp-content/"));
					echo $source="C:/".$dirname;
					echo "*********";
					 $file=basename($source);
					echo $dest=$b1['catg1']."/".$file;

					if(copy($source,$dest))
						{
							echo "single Copied";

							$ext = pathinfo($file, PATHINFO_EXTENSION);
								echo $ext;

								/*echo "<br>";
								echo $b1['serial_number']."-".$i.".".$ext;*/
							
							$old=$dest;
							$new=$b1['catg1']."/".$b1['serial_number'].".".$ext;

							rename($old,$new);

						}
				$catg=$b1['catg1'];

						$sno=$b1['serial_number'];
						$qryUpd=$crud->execute("update webdata2 set postType='1' where 
						 catg1='$catg' and serial_number='$sno'");
			}
		}
	}


?>