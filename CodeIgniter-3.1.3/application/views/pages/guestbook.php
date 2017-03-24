<?php echo img(array('src' => 'images/candle.gif', 'alt' => 'Animated Candle', 'id' => 'candle')); ?>

<table width="400" border="0" align="center" cellpadding="3" cellspacing="0">
	<tr>
		<td id="guest_greeting"><strong>Thank you for visiting! Please sign the guestbook.</style></strong></td>
	</tr>
</table>

<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#cccccc">
	<tr>
		<form id="form1" name="form1" method="post" action="<?php echo base_url('index.php/addguestbook') ?>">
		<td>
			<table width="400" border="0" cellpadding="3" cellspacing="1" bgcolor="#ffffff">
				<tr>
					<td width="117">Name: </td>
					<td width="357"><input name="name" type="text" id="name" size="40" /></td>
				</tr>
				<tr>
					<td>Email: </td>
					<td><input name="email" type="email" id="email" size="40" /></td>
				</tr>
				<tr>
					<td valign="top">Comment: </td>
					<td><textarea name="comment" cols="40" rows="3" id="comment"></textarea></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="submit" name="submit" value="submit" />
						<input type="reset" name="submit2" value="Reset" />
					</td>
				</tr>
			</table>
		</td>
		</form>
	</tr>
</table>
			
<table width="400" border="0" align="center" cellpadding="3" cellspacing="0">
	<tr>
		<td><strong><a href="<?php echo base_url('index.php/viewguestbook') ?>">View Guestbook</a></strong></td>
	</tr>
</table>
				