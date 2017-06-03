<?php
define('AVATARS_DIRECTORY', 'uploads/avatars/');

function download($path, $downloadName = null)
{
	if (file_exists($path))
	{
		if(!$downloadName)
		{
			$downloadName = basename($path);
		}

	    header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename="' . $downloadName . '"');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($path));
	    readfile($path);
	    exit;
	}
}