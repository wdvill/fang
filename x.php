<?php
	$file = "csdn.sql";
	$fp = fopen($file, "r");
	$i = 0;
	while (!feof($fp)) {
			$line = fgets($fp);
			// ���������ӶԶ����е����ݽ�����������

			if( strpos($line, "dashi") ) {
				echo $line;
				echo "<br />";
			}
		$i++;	

	}
	echo $i;
	fclose ($fp);
?>