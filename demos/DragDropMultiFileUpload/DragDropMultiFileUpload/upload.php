<?php
if (isset($_FILES['file'])) {
	if(move_uploaded_file($_FILES['file']['tmp_name'], "uploads/".$_FILES['file']['name'])){
		echo "success";
	}
	else
	{
		echo "fail";

	}
}
	exit;
