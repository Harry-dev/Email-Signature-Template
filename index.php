<?php
$output = (isset($_GET['output']) ? htmlspecialchars($_GET['output']) : NULL);
$target = (isset($_GET['target']) ? htmlspecialchars($_GET['target']) : NULL);
$basepath = ($_SERVER['HTTPS'] ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];

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
		a:hover{
			text-decoration: none !important;
		}
	</style>
	<table cellspacing="0" cellpadding="0" border="0" width="362">
		<tbody>
			<tr>				
				<td width="137" class="image" style="min-width: 137px; border: 5px solid transparent; border-left: 8px solid transparent; vertical-align: top; border-top: 0 none; border-right: 0 none;">
					<img src="http://moulislegal.com/signature/images/logo.png" alt="Moulis Legal" width="120" height="150" />
				</td>
				<td width="225" style="min-width: 225px; vertical-align: top; border: 5px solid transparent; border-top: 0 none;">
					<h1 style="color: #EE3124; margin: 0; font-family: Arial, sans-serif; font-size: 12px; font-weight: 600; mso-line-height-rule: exactly; line-height: 1.2; letter-spacing: 0.3px; margin-top: 93px;">Alexandra Lowson</h1>
					<p style="font-family: Arial, sans-serif; margin-top: 0; margin-bottom: 7px; font-size: 12px; mso-line-height-rule: exactly; line-height: 1.2; font-weight: 400; color: #231F20 !important; letter-spacing: 0.25px;">
						Administration and Marketing Officer					
					</p>
					<p style="font-family: Arial, sans-serif; margin-top: 0; margin-bottom: 5px; font-size: 12px; mso-line-height-rule: exactly; line-height: 1.2; font-weight: 600; color: #EE3124 !important; letter-spacing: 0.3px;">
						<font color="#EE3124">moulislegal</font>
						<br />
						<span style="color: #231F20 !important; font-weight: 400;">commercial+international</span>
					</p>
					<div class="details">
						<table cellspacing="0" cellpadding="0" border="0" width="155" style="font-family: Arial, sans-serif; font-size: 12px; mso-line-height-rule: exactly; line-height: 1.2; font-weight: 400; color: #939598 !important; letter-spacing: 0.3px;">
							<tbody>
								<tr>						
									<td><font color="#939598" style="mso-line-height-rule: exactly; line-height: 1.2;">Tel</font></td>
									<td><a href="tel:+61733676900" style="text-decoration: none;"><font color="#939598" style="mso-line-height-rule: exactly; line-height: 1.2;">+&#8203;61&#8203; 7&#8203; 3367&#8203; 6900</font></a></td>
								</tr>
								<tr>
									<td><font color="#939598" style="mso-line-height-rule: exactly; line-height: 1.2;">Fax</font></td>
									<td><a href="fax:+61261620606" style="text-decoration: none;"><font color="#939598" style="mso-line-height-rule: exactly; line-height: 1.2;">+&#8203;61&#8203; 2&#8203; 6162&#8203; 0606</font></a></td>
								</tr>
								<tr>
									<td><font color="#939598" style="mso-line-height-rule: exactly; line-height: 1.2;">Skype</font></td>
									<td style="border-left: 4px solid transparent;"><font color="#939598" style="mso-line-height-rule: exactly; line-height: 1.2;">moulislegalbrisbane</font></td>
								</tr>
							</tbody>
						</table>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	<?php if($output != 'file'): ?>
		<p>Download the HTML file of this signature for <a href="<?php print $basepath; ?>?output=file&amp;target=mac">OS X Mail</a>, <a href="<?php print $basepath; ?>?output=file&amp;target=outlook">Outlook</a> or <a href="<?php print $basepath; ?>?output=file">anything else</a></p>
	<?php endif; ?>
<?php if(($output == 'file' && $target != 'mac') || !$output): //Set closing tags ?>
	</body>
	</html>
<?php endif;
if($output == 'file' && $target == 'mac'): //Output specifically for mac ?>
	<br />&nbsp;
<?php endif; ?>