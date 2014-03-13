<?php
			echo "<table width='100%' border='0'>
			<tr>
			<td>Last</td>
			<td>First</td>
			<td>Phone</td>
			<td>More</td>
			</tr>";
$xmlDoc=new DOMDocument();
$xmlDoc->load("http://spires2.cityoffrederick.com/employee/mobile/xmldirectory.php");

$x=$xmlDoc->getElementsByTagName('Department');

//get the q parameter from URL
$q=$_GET["q"];

//lookup all links from the xml file if length of q>0
if (strlen($q)>0)
{
$hint="";
for($i=0; $i<($x->length); $i++)
  {
  $y=$x->item($i)->getElementsByTagName('First');
  $z=$x->item($i)->getElementsByTagName('Last');
  $p=$x->item($i)->getElementsByTagName('Phone');
  $d=$x->item($i)->getElementsByTagName('Dept.');
  $ID=$x->item($i)->getElementsByTagName('ID');
  $email=$x->item($i)->getElementsByTagName('Email');
  if ($y->item(0)->nodeType==1)
    {
    //find a link matching the search text
    if ((@stristr($y->item(0)->childNodes->item(0)->nodeValue,$q)) || (stristr($z->item(0)->childNodes->item(0)->nodeValue,$q)) || 
		(stristr($d->item(0)->childNodes->item(0)->nodeValue,$q)))
      {
      if ($hint=="")
        {
			$getID = $ID->item(0)->childNodes->item(0)->nodeValue;
			$getPhone = @$p->item(0)->childNodes->item(0)->nodeValue;
        $hint= "<tr>
			" .  
			"<td><a href='mailto:" .@$email->item(0)->childNodes->item(0)->nodeValue."'>".@$z->item(0)->childNodes->item(0)->nodeValue . "</a></td>" .    
			"<td>".@$y->item(0)->childNodes->item(0)->nodeValue . "</td>" .    
			"<td><a href = 'tel:$getPhone'>$getPhone</a></td>    
			<td><a href = 'more.php?ID=$getID'>&gt;&gt;</a></td>
			</tr>";
        }
      else
        {
			$getID = $ID->item(0)->childNodes->item(0)->nodeValue;
			$getPhone = @$p->item(0)->childNodes->item(0)->nodeValue;
			$hint=$hint . "<tr>
			" .  
			"<td><a href='mailto:" .@$email->item(0)->childNodes->item(0)->nodeValue."'>".@$z->item(0)->childNodes->item(0)->nodeValue . "</a></td>" .    
			"<td>".@$y->item(0)->childNodes->item(0)->nodeValue . "</td>" .    
			"<td><a href = 'tel:$getPhone'>$getPhone</a></td>    
			<td><a href = 'more.php?ID=$getID'>&gt;&gt;</a></td>
			</tr>";
		}
      }
    }
  }
}

// Set output to "no suggestion" if no hint were found
// or to the correct values
if ($hint=="")
  {
  $response="no suggestion";
  }
else
  {
  $response=$hint;
  }

//output the response
echo $response;
			echo "</table>";        
?> 
