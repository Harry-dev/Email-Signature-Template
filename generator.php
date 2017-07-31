<?php
$csv_data = array();
$csv_headers = array();
$row = 0;
$handle = fopen('email.csv', 'r');

//Store CSV Data
if(empty($handle) === false) {
    while(($data = fgetcsv($handle, 1000, ",")) !== FALSE){
        if(!$row){
        	$csv_headers = $data;
        } else {
       		$new_data = array_combine($csv_headers, $data); 
       		if(isset($new_data['name'])){
       			$email = trim($new_data['name']);
       			$csv_data[$email] = $new_data;
       		}
        }
        $row++;
    }
    fclose($handle);
} else {
	print "<p>Problem opening 'email.csv'</p>";
}

//Set output
$basepath = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];
$output = (isset($_GET['output']) ? htmlspecialchars($_GET['output']) : NULL);
$target = (isset($_GET['target']) ? htmlspecialchars($_GET['target']) : NULL);

//Set headers
if($output != 'file' || ($output == 'file' && $target != 'mac')):?>
<!DOCTYPE html>
<html lang="en"><body>	
<?php endif;

if($output == 'file'):
	$filename = 'signature.html';
	if ($target == 'outlook') $filename =  'signature.HTM';
	if ($target == 'mac') $filename =  'signature_mac.html';
	
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.$filename); 
endif; ?>




<style type="text/css">
	p, h1 {
		margin: 0;
	}

	a {
		color: red;
		transition: color 0.5s ease-out;
	}

	a:visited{
		color: #000 !important;
	}

	a:hover{
		color: #000 !important;
	}

</style>




<?php if(isset($_GET['name']) && $_GET['name'] && isset($csv_data[$_GET['name']])): 
	$email_address = htmlspecialchars($_GET['name']);
	$record = $csv_data[$email_address];

	$address = array();
	if(isset($record['address']) && $record['address']){
		switch($record['address']){
			case 'canberra':
				$address = array('tel' => '1800 1234', 'address_1' => '123 Generic St', 'address_2' => 'Canberra ACT, 2603' );
			break;
		}
	}
?>



<!-- START TEMPLATE -->
<table width="202" cellpadding="0" cellspacing="0" border="0">
	<tbody>
		<tr>
			<td colspan="2" align="left">
				<img src="http://thinktank.swelldesign.com.au/proj-path/img/logo.png" width="151 " height="52">
			</td>
		</tr>
		<tr>
			<td width="52"></td>
			<td width="150">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tbody>
						<tr>
							<td height="15" style="font-size:15px; line-height:15px;">&nbsp;</td>
						</tr>
						<tr>
							<td align="left">
								<span style="font-family:Arial; font-weight: bold; color:#000000; font-size:11px; line-height:1.2;"><?php print $record['name']; ?></span>
							</td>
						</tr>
						<tr>
							<td align="left">
								<span style="font-family:Arial; color:#000; font-size:11px; line-height:1.2;"><?php print $record['title']; ?></span>
							</td>
						</tr>
						<tr>
							<td height="13" style="font-size:11px; line-height:10px;">&nbsp;</td>
						</tr>



						<tr>
							<td align="left">
								<a href="tel:0422 229 301" target="_blank" style="font-family:Arial; color:#000; font-size:11px; text-decoration:none; line-height:1.2;"><?php print str_replace(' ', '&#8203; ', $address['tel']); ?></a>
							</td>
						</tr>
						<tr>
							<td align="left">
								<a href="mailto:jocelyn@antalija.com.au" target="_blank" style="font-family:Arial; color:#000; font-size:11px; text-decoration:underline; line-height:1.2;"><?php print str_replace(' ', '&#8203; ', $record['email']); ?></a>
							</td>
						</tr>
						<tr>
							<td height="13" style="font-size:11px; line-height:10px;">&nbsp;</td>
						</tr>
						<tr>
							<td align="left">
								<span style="font-family:Arial; color:#58595b; font-size:11px; line-height:1.2;">
									<?php print $address['address_1']; ?>
									<br>
									<?php print $address['address_2']; ?>
								</span>
							</td>
						</tr>
						<tr>
							<td align="left">
								<a href="http://www.antalija.com.au" target="_blank" style="font-family:Arial; color:#58595b; font-size:11px; text-decoration:underline; line-height:1.2;">www.antalija.com.au</a>
							</td>
						</tr>
						<tr>
							<td height="13" style="font-size:11px; line-height:10px;">&nbsp;</td>
						</tr>



						<tr>
							<td align="left">
								<span style="font-family:Arial; color:#58595b; font-size:11px; line-height:1.2;">Antalija Building Pty Ltd</span>
							</td>
						</tr>
						<tr>
							<td align="left">
								<span style="font-family:Arial; color:#58595b; font-size:11px; line-height:1.2;">Builders Licence 2069449</span>
							</td>
						</tr>
						<tr>
							<td height="13" style="font-size:11px; line-height:10px;">&nbsp;</td>
						</tr>
					</tbody>
				</table>


				
				<table align="left" cellpadding="0" cellspacing="0" border="0">
					<tbody>
						<tr>
							<td align="left" valign="top">
								<a href="https://www.instagram.com/" target="_blank"><img src="http://i.imgur.com/dj12s9F.png" width="14" height="14"></a>
							</td>
							<td width="3">&nbsp;</td>
							<td align="left" valign="top">
								<a href="http://facebook.com" target="_blank"><img src="http://i.imgur.com/L27MDAa.png" width="14" height="14"></a>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
<!-- END TEMPLATE -->



<!-- DOWNLOAD FILE -->
	<?php if($output != 'file'): ?>
		<p></p>
		<p style="font-family: Arial, sans-serif; margin-top: 0; font-size: 12px; mso-line-height-rule: exactly; line-height: 1; font-weight: 400; letter-spacing: 0.2px; margin-left: 5px;">
		Download the HTML file of this signature for 
		<a style="text-decoration: none;" href="<?php print $basepath . '?name=' . $_GET['name']; ?>&amp;output=file&amp;target=mac">OS X Mail</a>, 
		<a style="text-decoration: none;" href="<?php print $basepath . '?name=' . $_GET['name']; ?>&amp;output=file&amp;target=outlook">Outlook</a> or 
		<a style="text-decoration: none;" href="<?php print $basepath . '?name=' . $_GET['name']; ?>&amp;output=file">anything else</a></p>
	<?php endif; ?>
<?php else:
	//email not found
	if(isset($_GET['name']) && isset($csv_data[$_GET['name']])): ?>
		<p>Not found! Please try again.</p>
	<?php endif;
	
	if(!empty($csv_data)): ?>
		<p><strong>Please select a signature:</strong></p>
		<ul>
			<?php 
			foreach($csv_data as $key=>$value): 
				if(isset($value['name']) && $value['name']):
			?>
				<li><a href="<?php print $basepath; ?>?name=<?php print $value['name'] ?>"><?php print $value['name']; ?></a></li>
			<?php 
				endif;
			endforeach; ?>
		</ul>
	<?php endif;
endif; ?>
<?php if(($output == 'file' && $target != 'mac') || !$output): //Set closing tags ?>
	</body>
	</html>
<?php endif;
if($output == 'file' && $target == 'mac'): //Output specifically for mac ?>
	<br />&nbsp;
<?php endif; ?>

<!-- HOW TO INSTALL -->
	<!-- SPACER - Height -->
	<td colspan="2">
		<img src="http://thinktank.swelldesign.com.au/proj-path/img/spacer.gif" width="1" height="25" />
	</td>	

	<p style="font-family: Arial, sans-serif; margin-top: 0; font-size: 12px; mso-line-height-rule: exactly; line-height: 1; font-weight: 400; letter-spacing: 0.2px; margin-left: 5px;">
	Installation instructions: &nbsp;
	<a style="text-decoration: none;" href="http://myhtmlsignature.com/installing-your-email-signature-in-outlook-2013/" target="_blank">Outlook</a>, 
	<a style="text-decoration: none;" href="http://myhtmlsignature.com/how-to-install-an-html-signature-in-mountain-lion/" target="_blank">OS X Mail</a>, or 
	<a style="text-decoration: none;" href="http://myhtmlsignature.com/how-to-install-an-email-signature-in-gmail/" target="_blank">Gmail</a></p>