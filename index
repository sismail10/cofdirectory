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
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png?v2" />
    
    <!--
        Add a splash screen / startup image.
        Take note this file exactly needs to be 320x460 for iPhone or 1004x768 for iPad, and is a PNG file.
        Also, this only works if "apple-mobile-web-app-capable" is set to "yes".
    -->
    <link rel="apple-touch-startup-image" href="images/startup.png?v2" />
    
    <!--
        Prevent the user from elastic scrolling / rubber banding. Sadly, doesn't always work properly.
        For a more solid solution, check out ScrollFix ( https://github.com/joelambert/ScrollFix )
    -->
    <script>
/*    function BlockElasticScroll(event) {
        event.preventDefault() ;
    }
    
    // In JavaScript, you can use "window.navigator.standalone" to detect wether
    // the page is being viewed on your website, or as a standalone application.
    
    // You can also the detect the device the user is using.
    // var isIPhone = navigator.userAgent.indexOf("iPhone") != -1 ;
    // var isIPod = navigator.userAgent.indexOf("iPod") != -1 ;
    // var isIPad = navigator.userAgent.indexOf("iPad") != -1 ;
    // var isIOs = isIPhone || isIPod || isIPad ;
 */   
    </script>
<script type="text/javascript">

    if(("standalone" in window.navigator) && window.navigator.standalone){

    var noddy, remotes = false;

    document.addEventListener('click', function(event) {

    noddy = event.target;

    while(noddy.nodeName !== "A" && noddy.nodeName !== "HTML") {
    noddy = noddy.parentNode;
    }

    if('href' in noddy && noddy.href.indexOf('http') !== -1 && (noddy.href.indexOf(document.location.host) !== -1 || remotes))
    {
    event.preventDefault();
    document.location.href = noddy.href;
    }

    },false);
    }
</script>

<link rel="stylesheet" href="css/add2home.css">
<script type="application/javascript" src="src/add2home.js"></script>

    <title>COF Directory</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>

<!--- Search Scripts --->
<script>
function showResult(str)
{
if (str.length==0)
  {
  document.getElementById("livesearch").innerHTML="";
  document.getElementById("livesearch").style.border="0px";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
    document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
xmlhttp.open("GET","livesearch.php?q="+str,true);
xmlhttp.send();
}
</script>
</head>

<!---<body ontouchmove="BlockElasticScroll(event);"> --->
<body>
<p>
  <div align="center">
    <input type="text" size="35" onKeyUp="showResult(this.value)" placeholder="Search by First or Last Name or by Dept." style="height: 30px;">
  </div>
  <div id="livesearch">
    
    <p>
  <?php
					require("http://spires2.cityoffrederick.com/employee/connect.php");
					$table = "employees";
					
					$params = array();
					$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
					
					//$data = sqlsrv_query($conn, "SELECT Department,lName,fName,Title,Extension,Email,MailStop,Cell,Radio FROM $table $query", $params, $options) or die ("Connection no Good");
					$sql = "SELECT ID, Department,lName,fName,Title,Extension,Email,Mailstop,Cell,Radio FROM employees
							ORDER BY Department, lName";
					
					$data = sqlsrv_query($conn, $sql, $params, $options) or die ("Query was no Good");
?>
</p>
    <table width="100%" border="0">
      <tr>
        <td>Last</td>
        <td>First</td>
        <td>Phone</td>
        <td>More</td>
      </tr>
      <?php
		while($row = sqlsrv_fetch_array($data))
		{
			if (strpos($row["Extension"],'301') !== false)
			{
				$phonenum = $row["Extension"];
			}
			else
				$phonenum = "301-".$row["Extension"];
					
			echo "<tr>";
			echo "<td><u><a href = 'mailto:$row[Email]'>$row[lName]</a></u></td>";
			echo "<td>$row[fName]</td>";
			echo "<td>$phonenum</td>";
			echo "<td><a href = 'more.php?ID=$row[ID]'>&gt;&gt;</a></td>";
			echo "</tr>";
		}
		?>
</table>
</div>
</p>
</body>
</html>
