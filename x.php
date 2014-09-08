<?php
	$file = "csdn.sql";
	$fp = fopen($file, "r");
	$i = 0;
	while (!feof($fp)) {
			$line = fgets($fp);
			// 这里可以添加对读出行的内容进行其他处理

			if( strpos($line, "dashi") ) {
				echo $line;
				echo "<br />";
			}
		$i++;	

	}
	echo $i;
	fclose ($fp);
?>