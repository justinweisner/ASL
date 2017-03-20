<?php

//disabling any warnings

if (version_compare(phpversion(), "5.3.0", ">=") == 1)
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
else
	error_reporting(E_ALL & ~E_NOTICE);

require_once('class/CMySQL.php'); // To work with Database

//Get last guestbook records.

function getLastRecords($iLimit = 3) {
	$sRecord = '';
	$aRecords = $GLOBALS['MySQL']->getAll("SELECT * FROM 'Nick_Guestbook' ORDER BY 'id' DESC LIMIT {$iLimit}");
	foreach ($aRecords as $i => $aInfo) {
		$sWhen = date('F j, Y H:i', $aInfo['date']);
		$sRecords .= <<<EOF
		<div class="record" id="{$aInfo['id']}">
		<p>Record from {$aInfo['name']} <span>({$sWhen})</span>:</p>
		<p>{$aInfo['description']}</p>
		</div>
		EOF;
	}
	return $sRecords;
}

if ($_POST) { // accepting new records
    $sName= $GLOBALS['MySQL']->escape(strip_tags($_POST['name']));
	$sEmail= $GLOBALS['MySQL']->escape(strip_tags($_POST['name']));
    $sDesc= $GLOBALS['MySQL']->escape(strip_tags($_POST['text']));
	
	if ($sName && sEmail && $sDesc) {
		//Spam protection
		$iOldId = $GLOBALS['MySQL']->getOne("SELECT 'id FROM 'Nick_Guestbook' where 'date' >= UNIX_TIMESTAMP() - 600 LIMIT 1");
		if (! $iOldId){
			//Allows Comments
			$GLOBALS['MySQL']->res("INSERT INTO 'Nick_Guestbook' Set 'name' = '{$sName}', 'email' = '{$sEmail}', 'description' = '{$sDesc}', 'date' = UNIX_TIMESTAMP()");
			// Drawing last 10 records
			$sOut = getLastRecords();
			echo $sOut;
			exit;
		}
	}
	echo 1;
	exit;
}

//Drawing last 10 Records
$sRecords = getLastRecords();
ob_start();
?>

<!--Building the Guestboot HTML-->

	<div class="guestbook_container" id="records">
		<div id="col1">
			<h2>Guestbook Records</h2>
			
			<div id="records_list"><?= $sRecords ?> </div>
		</div>
		<div id="col2">
			<h2>Add your Record here.</h2>
			
			<!--JAVASCRIPT-->
			<script type="text/javascript">
				function submitComment(e){
					var name = $('#name').val();
					var email = $('#email').val();
					var text = $('#text').val();
					
					if (name && email && text){
						$.post('guestbook.php', {'name':name, 'email':email, 'text':text},
							  function(data){
								if (data != '1'){
									$('#records_list').fadeOut(1000, function() {
										$(this).html(data);
										$(this).fadeIn(1000);
									});
								}else{
									$('#warning').fadeIn(2000, function() {
										$(this).fadeOut(2000);
									});
								}
								}
						);
					}else{
						$('#warning1').fadeIn(2000, function(){
							$(this).fadeOut(2000);
						});
					}
				};
			</script>
			
			<form onSubmit="submitComment(this); return false;">
			<table>
				<tr><td class="label"><label>Your Name: </label></td><td class="field"><input type="text" value="" title="Please enter your name." id="name" /></td></tr>
				<tr><td class="label"><label>Your Email: </label></td><td class="field"><input type="text" value="" title="Please enter your Email." id="email" /></td></tr>
				<tr><td class="label"><label>Comments: </label></td><td class="field"><textarea name="text" id="name" maxlength="1000"></textarea></td></tr>
				<tr><td class="label">&nbsp;</td><td class="field">
					<div id="warning1" style="display:none">Don`t forget to fill all required fields</div>
					<div id="warning2" style="display:none">You can post no more than one comment every 10 minutes (spam protection)</div>
					<input type="submit" value="Submit" /></td></tr>
			</table>
			</form>
		</div>
	</div>
	
<? $sGuestbookBlock = ob_get_clean(); ?>

<?= $sGuestbookBlock ?>







































?>