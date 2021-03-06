<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    
    <!-- Set the viewport to show the page at a scale of 1.0, and make it non-scalable -->
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
    
    <!-- Make it fullscreen / hide the browser URL bar -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    
    <!--
        Give the status bar another colour
        Valid values for "content" are: "default" (white), "black" and "black-translucent"
        If set to "default" or "black", the content is displayed below the status bar. If set to
        "black-translucent", the content is displayed under the bar.
    -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    
    <!--
        Add a Home icon.
        By default, Mobile Safari searches for a file named "apple-touch-icon.png" in the root directory of your website.
        If it can't find any image there, you can specify it using the code below. Make sure the image has a dimension
        of 114x114 and is a PNG file. The glossy finish and resizing for the different devices will be done automatically.
        
        In case you don't want the gloss applied, use "apple-touch-icon-precomposed" instead of "apple-touch-icon".
    -->
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png" />
    
    <!--
        Add a splash screen / startup image.
        Take note this file exactly needs to be 320x460 for iPhone or 1004x768 for iPad, and is a PNG file.
        Also, this only works if "apple-mobile-web-app-capable" is set to "yes".
    -->
    <link rel="apple-touch-startup-image" href="images/startup.png" />
    
    <!--
        Prevent the user from elastic scrolling / rubber banding. Sadly, doesn't always work properly.
        For a more solid solution, check out ScrollFix ( https://github.com/joelambert/ScrollFix )
    -->
    <script>
    function BlockElasticScroll(event) {
        event.preventDefault() ;
    }
    
    // In JavaScript, you can use "window.navigator.standalone" to detect wether
    // the page is being viewed on your website, or as a standalone application.
    
    // You can also the detect the device the user is using.
    // var isIPhone = navigator.userAgent.indexOf("iPhone") != -1 ;
    // var isIPod = navigator.userAgent.indexOf("iPod") != -1 ;
    // var isIPad = navigator.userAgent.indexOf("iPad") != -1 ;
    // var isIOs = isIPhone || isIPod || isIPad ;
    
    </script>

    <title>More Details</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>

</head>
<body ontouchmove="BlockElasticScroll(event);">
<p>
  <?php

	if(isset($_GET['ID']))
	{
		$ID = $_GET['ID'];

	require("http://spires2.cityoffrederick.com/employee/connect.php");
	$table = "employees";
	
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	
	//$data = sqlsrv_query($conn, "SELECT Department,lName,fName,Title,Extension,Email,MailStop,Cell,Radio FROM $table $query", $params, $options) or die ("Connection no Good");
	$sql = "SELECT ID, Department,lName,fName,Title,Extension,Email,Mailstop,Cell,Radio 
			FROM employees
			Where ID = $ID
			ORDER BY Department, lName";
	
	$data = sqlsrv_query($conn, $sql, $params, $options) or die ("Query was no Good");

	while($row = sqlsrv_fetch_array($data))
	{
		if (strpos($row["Extension"],'301') !== false)
		{
			$phonenum = $row["Extension"];
		}
		else
			$phonenum = "301-".$row["Extension"];
				
?>
</p>
<table width="75%" border="0" align="center" cellpadding="10" cellspacing="2">
  <tr>
    <td>Name</td>
    <td><?php echo "$row[fName] $row[lName]";?></td>
  </tr>
  <tr>
    <td>Title</td>
    <td><?php echo "$row[Title]";?></td>
  </tr>
  <tr>
    <td>Dept.</td>
    <td><?php echo "$row[Department]";?></td>
  </tr>
  <tr>
    <td>Phone</td>
    <td><?php echo "$phonenum";?></td>
  </tr>
  <tr>
    <td>Cell</td>
    <td><?php echo "$row[Cell]";?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><?php echo "<a href = 'mailto:$row[Email]'>$row[Email]</a>";?></td>
  </tr>
  <tr>
    <td>Mail</td>
    <td><?php echo "$row[Mailstop]";?></td>
  </tr>
  <tr>
    <td>Radio</td>
    <td><?php echo "$row[Radio]";?></td>
  </tr>
  <tr>
    <td colspan="2"><button type="button" onclick="javascript:history.go(-1)" style="height: 50px;">Go Back</button> </td>
  </tr>
</table>

<?php
	}
	}
	else
		die("First and Last Name required");
?>
</body>
</html>
