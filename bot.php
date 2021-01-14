<?php
error_reporting(0);
$tok = '1540311117:AAFUie0HFhpzVM2yrjxNMt1mtcenT8XE1y0';
function botaction($method, $data){
	global $tok;
	global $dadel;
	global $dueto;
    $url = "https://api.telegram.org/bot$tok/$method";
    $curld = curl_init();
    curl_setopt($curld, CURLOPT_POST, true);
    curl_setopt($curld, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curld, CURLOPT_URL, $url);
    curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($curld);
    curl_close($curld);
    $dadel = json_decode($output,true);
    $dueto = $dadel['description'];
    return $output;
}
function startsWith($content,$startString)
{
$con_arr = explode(' ',$content);
	if($con_arr['0'] == $startString)
	{
	return true;
	}
	else
	{
	return false;
	}
}

$update = file_get_contents('php://input');
$update = json_decode($update, true);


$mid = $update['message']['message_id'];
$cid = $update['message']['chat']['id'];
$uid = $update['message']['chat']['id'];
$cname = $update['message']['chat']['username'];
$fid = $update['message']['from']['id'];
$fname = $update['message']['from']['first_name'];
$lname = $update['message']['from']['last_name'];
$uname = $update['message']['from']['username'];
$typ = $update['message']['chat']['type'];
$texts = $update['message']['text'];
$text = strtolower($update['message']['text']);
$fullname = ''.$fname.' '.$lname.'';

##################NEW MEMBER DATA ################
$new_member = $update['message']['new_chat_member'];
$gname = $update['message']['chat']['title'];
$nid = $update['message']['new_chat_member']['id'];
$nfname = $update['message']['new_chat_member']['first_name'];
$nlname = $update['message']['new_chat_member']['last_name'];
$nuname = $update['message']['new_chat_member']['username'];
$nfullname = ''.$nfname.' '.$nlname.'';
#################################################
$lfname = $update['message']['left_chat_member']['first_name'];
$llname = $update['message']['left_chat_member']['last_name'];
$luname = $update['message']['left_chat_member']['username'];
$reply_message = $update['message']['reply_to_message'];
$reply_message_id = $update['message']['reply_to_message']['message_id'];
$reply_message_user_id = $update['message']['reply_to_message']['from']['id'];
$reply_message_text = $update['message']['reply_to_message']['text'];
$reply_message_user_fname = $update['message']['reply_to_message']['from']['first_name'];
$reply_message_user_lname = $update['message']['reply_to_message']['from']['last_name'];
$reply_message_user_uname = $update['message']['reply_to_message']['from']['username'];
#######################################################################################
###########################CALL BACK DATA##############################################
$callback = $update['callback_query'];
$callback_id = $update['callback_query']['id'];
$callback_from_id = $update['callback_query']['from']['id'];
$callback_from_uname = $update['callback_query']['from']['username'];
$callback_from_fname = $update['callback_query']['from']['first_name'];
$callback_from_lname = $update['callback_query']['from']['last_name'];
$callback_user_data = $update['callback_query']['data'];
$callback_message_id = $update['callback_query']['message']['id'];
$cbid = $update['callback_query']['message']['chat']['id'];
$cbmid = $update['callback_query']['message']['message_id'];
function encrypt($data){
	$data = str_split($data);
	$custom_enc = array("0"=>"asr","1"=>"Ar_","2"=>"Des","3"=>"A3e","4"=>"Fer","5"=>"Fes","6"=>"4Sd","7"=>"Zve","8"=>"Op4","9"=>"M4V");
	$encrypt = '';
	foreach($data as $letter){
	$encrypt .= $custom_enc["$letter"];
	}
	return $encrypt;
}
$your_token = encrypt($cid);
if ($text == '/start') {
  $start_message_and_key = "Hey $fname, Thanks For Registering With This API Service...Here's Your Api Key \n\n <b>Your Api Token</b> : <code>$your_token</code> \n\n Remember That This Api Only Works If You Join Our Telegram Channel @NoobsGang . Stay Tuned For More Updates..\nRegards,\n@NoobsGang.";
  botaction("sendMessage",['chat_id'=>$cid,'reply_to_message_id'=>$mid,'parse_mode'=>'HTML','text'=>$start_message_and_key]);
  file_get_contents("https://api.noobgang.online/CustomSms/add_user.php?id=$cid");
}
?>
