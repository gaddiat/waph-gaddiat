<?php
	if (!isset($_REQUEST["data"])) {
		die("{\"error\":\"please provide 'data' field\"}");
	}
	echo htmlentities($_REQUEST["data"]);
?>