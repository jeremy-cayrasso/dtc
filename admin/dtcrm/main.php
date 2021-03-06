<?php

function DTCRMlistClients(){
	if(isset($_REQUEST["id"]))
		$id_client = $_REQUEST["id"];
	global $pro_mysql_client_table;
	global $pro_mysql_admin_table;

	// The popup value is stored in the session, let's manage it
	if(isset($_REQUEST["clientlist_type"]) && $_REQUEST["clientlist_type"] != ""){
		$_SESSION["cur_clientlist_type"] = $_REQUEST["clientlist_type"];
		$clientlist_type = $_REQUEST["clientlist_type"];
	}else{
		if(isset($_SESSION["cur_clientlist_type"]) && $_SESSION["cur_clientlist_type"] != ""){
			$clientlist_type = $_SESSION["cur_clientlist_type"];
		}else{
			$clientlist_type = "hide-no-admins";
			$_SESSION["cur_clientlist_type"] = "hide-no-admins";
		}
	}

	$text = "<div style=\"white-space: nowrap\" nowrap>
<a href=\"".$_SERVER["PHP_SELF"]."?rub=crm&id=0\">". _("New customer") ."</a>
</a><br><br>";

	$query = "SELECT * FROM $pro_mysql_client_table ORDER BY familyname";
	$result = mysql_query($query)or die("Cannot query \"$query\" !!!".mysql_error());
	$num_rows = mysql_num_rows($result);
	$client_list = array();
	if(isset($id_client) && $_REQUEST["id"] == 0){
		$selected = "yes";
	}else{
		$selected = "no";
	}
	$client_list[] = array(
		"text" => _("New customer") ,
		"link" => $_SERVER["PHP_SELF"]."?rub=crm&id=0",
		"selected" => $selected);
	for($i=0;$i<$num_rows;$i++){
		$row = mysql_fetch_array($result);
		if($clientlist_type == "hide-no-admins"){
			$qa = "SELECT adm_login FROM $pro_mysql_admin_table WHERE id_client='".$row["id"]."';";
			$ra = mysql_query($qa)or die("Cannot query $qa line ".__LINE__." file ".__FILE__." sql said: ".mysql_error()); 
			$rn = mysql_num_rows($ra);
			if($rn == 0){
				$do_display = "no";
			}else{
				$do_display = "yes";
			}
		}else{
			$do_display = "yes";
		}
		if($do_display == "yes"){
			if(!isset($id_client) || $row["id"] != $_REQUEST["id"]){
				$text .= "<a href=\"".$_SERVER["PHP_SELF"]."?rub=crm&id=".$row["id"]."\">";
				$url = $_SERVER["PHP_SELF"]."?rub=crm&id=".$row["id"];
				$selected = "no";
			}else{
				$url = $_SERVER["PHP_SELF"]."?rub=crm&id=".$row["id"];
				$selected = "yes";
			}
			if($row["is_company"] == "yes"){
				if(strlen($row["company_name"]) > 15){
					$company = substr($row["company_name"],0,14)."...: ";
				}else{
					$company = $row["company_name"].": ";
				}
			}else{
				$company = "";
			}
			$text .= $company.$row["familyname"].", ".$row["christname"]."";
			if(!isset($id_client) || $row["id"] != $_REQUEST["id"]){
				$text .= "</a>";
			}
			$text .= "<br>";
			$client_list[] = array(
				"text" => $company.$row["familyname"].", ".$row["christname"],
				"link" => $url,
				"selected" => $selected);
		}
	}
	$text .= "</div>";
	if(function_exists("skin_DisplayClientList")){
		$out = skin_DisplayClientList($client_list);
	}else{
		$out = $text;
	}

	// A popup to select to print all customers or not display the one without admins
	if($clientlist_type == "hide-no-admins"){
		$selectedlist_hide_no_admin = " selected";
		$selectedlist_show_all = "";
	}else{
		$selectedlist_hide_no_admin = "";
		$selectedlist_show_all = " selected";
	}
       $list_prefs = "<div class=\"box_wnb_nb_content\">
<div style=\"white-space: nowrap\" nowrap><form action=\"".$_SERVER["PHP_SELF"]."\"><font size=\"-2\">". _("Show:")  ."<br>
<input type=\"hidden\" name=\"rub\" value=\"crm\">
<select class=\"box_wnb_nb_input\" name=\"clientlist_type\">
<option value=\"hide-no-admins\"$selectedlist_hide_no_admin>". _("Hide client without admin") ."
<option value=\"show-all\"$selectedlist_show_all>"._("Show all")."
</select>
<div class=\"box_wnb_nb_input_btn_container\" onMouseOver=\"this.className='box_wnb_nb_input_btn_container-hover';\" onMouseOut=\"this.className='box_wnb_nb_input_btn_container';\">
 <div class=\"box_wnb_nb_input_btn_left\"></div>
 <div class=\"box_wnb_nb_input_btn_mid\"><input class=\"box_wnb_nb_input_btn\" type=\"submit\" value=\""._("Ok")."\"></div>
 <div class=\"box_wnb_nb_input_btn_right\"></div>
</div></form><br></div>
<div class=\"voider\"></div>
</div>
";

	return $list_prefs . $out;
}

function DTCRMclientAdmins(){
	global $pro_mysql_client_table;
	global $pro_mysql_admin_table;

	$q = "SELECT * FROM $pro_mysql_admin_table WHERE id_client='".$_REQUEST["id"]."'";
	$r = mysql_query($q)or die("Cannot execute query: \"$q\" line ".__LINE__." in file ".__FILE__.", mysql said: ".mysql_error());
        $n = mysql_num_rows($r);
	$text = "<br><h3>". _("Remove an administrator for this customer:") ."</h3><br>";
	for($i=0;$i<$n;$i++){
		$a = mysql_fetch_array($r);
		if($i > 0)
			$text .= " - ";
		$text .= "<a href=\"".$_SERVER["PHP_SELF"]."?rub=crm&id=".$_REQUEST["id"]."&action=remove_admin_from_client&adm_name=".$a["adm_login"]."\">".$a["adm_login"]."</a>";
	}

	$q = "SELECT * FROM $pro_mysql_admin_table WHERE id_client='0'";
	$r = mysql_query($q)or die("Cannot execute query: \"$q\" line ".__LINE__." in file ".__FILE__.", mysql said: ".mysql_error());
        $n = mysql_num_rows($r);
	$text .= "<br><br><h3>". _("Add an administrator to this customer:") ."</h3><br>";
	$text .= "<form action=\"".$_SERVER["PHP_SELF"]."\">
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tr><td><input type=\"hidden\" name=\"rub\" value=\"".$_REQUEST["rub"]."\">
<input type=\"hidden\" name=\"id\" value=\"".$_REQUEST["id"]."\">
<input type=\"hidden\" name=\"action\" value=\"add_admin_to_client\">
<select name=\"adm_name\">";
	for($i=0;$i<$n;$i++){
		$a = mysql_fetch_array($r);
		if($i > 0)
			$text .= " - ";
		$text .= "<option value=\"".$a["adm_login"]."\">".$a["adm_login"]."</option>";
	}
	$text .= "</select></td><td><div class=\"input_btn_container\" onMouseOver=\"this.className='input_btn_container-hover';\" onMouseOut=\"this.className='input_btn_container';\">
 <div class=\"input_btn_left\"></div>
 <div class=\"input_btn_mid\"><input class=\"input_btn\" type=\"submit\" value=\"Ok\"></div>
 <div class=\"input_btn_right\"></div>
</div></td></tr></table></form>";

	return $text;
}

function DTCRMeditClients(){
	global $pro_mysql_client_table;

	if(isset($_REQUEST["id"])){
		$cid = $_REQUEST["id"];	// current customer id
	}else{
		return _("Select a customer.") ;
	}

	$iscomp_yes = "checked";
	$iscomp_no = "";
	if($cid != 0 && isset($cid) && $cid != ""){
		$query = "SELECT * FROM $pro_mysql_client_table WHERE id='".$_REQUEST["id"]."';";
	        $result = mysql_query($query)or die("Cannot query \"$query\" !!!".mysql_error());
	        $num_rows = mysql_num_rows($result);
		if($num_rows != 1){
			return "<font color=\"red\">Error : no row by that client ID (".$_REQUEST["id"].") !!!</font>";
		}
		$row = mysql_fetch_array($result);
		$hidden_inputs = "<input type=\"hidden\" name=\"action\" value=\"edit_client\">";
		if($row["is_company"] == "no"){
			$iscomp_yes = "";
			$iscomp_no = "checked";
		}
	}else{
		$hidden_inputs = "<input type=\"hidden\" name=\"action\" value=\"new_client\">";
		unset($row);
		$row["familyname"] = "";
		$row["christname"] = "";
		$row["company_name"] = "";
		$row["vat_num"] = "";
		$row["addr1"] = "";
		$row["addr2"] = "";
		$row["addr3"] = "";
		$row["city"] = "";
		$row["zipcode"] = "";
		$row["state"] = "";
		$row["country"] = "us";
		$row["phone"] = "+";
		$row["fax"] = "";
		$row["email"] = "";
		$row["special_note"] = "";
		$row["dollar"] = "";
		$row["disk_quota_mb"] = "80";
		$row["bw_quota_per_month_gb"] = "1";
	}
	if(isset($row["special_note"])){
		$specnot = $row["special_note"];
	}else{
		$specnot = "";
	}
	$text = "<form action=\"".$_SERVER["PHP_SELF"]."\">
<input type=\"hidden\" name=\"rub\" value=\"crm\">
<input type=\"hidden\" name=\"id\" value=\"$cid\">$hidden_inputs
";
	$text .= dtcFormTableAttrs();
	$text .= dtcFormLineDraw( _("Familly name: ") ,"<input class=\"dtcDatagrid_input_color\" size=\"40\" type=\"text\" name=\"ed_familyname\"value=\"".stripcslashes($row["familyname"])."\">");
	$text .= dtcFormLineDraw( _("First name: ") ,"<input class=\"dtcDatagrid_input_alt_color\" size=\"40\" type=\"text\" name=\"ed_christname\" value=\"".stripcslashes($row["christname"])."\">",0);
	$text .= dtcFormLineDraw( _("Is it a company: ") ,"<input type=\"radio\" name=\"ed_is_company\" value=\"yes\" $iscomp_yes > "._("Yes")."
<input type=\"radio\" name=\"ed_is_company\" value=\"no\" $iscomp_no > "._("No"));
	$text .= dtcFormLineDraw( _("Company name: ") ,"<input class=\"dtcDatagrid_input_alt_color\" size=\"40\" type=\"text\" name=\"ed_company_name\" value=\"".stripcslashes($row["company_name"])."\">",0);
	$text .= dtcFormLineDraw( _("VAT number: ") ,"<input class=\"dtcDatagrid_input_color\" size=\"40\" type=\"text\" name=\"ed_vat_num\" value=\"".stripcslashes($row["vat_num"])."\">");
	$text .= dtcFormLineDraw( _("Address (line1): ") ,"<input class=\"dtcDatagrid_input_alt_color\" size=\"40\" type=\"text\" name=\"ed_addr1\" value=\"".stripcslashes($row["addr1"])."\">",0);
	$text .= dtcFormLineDraw( _("Address (line2): ") ,"<input class=\"dtcDatagrid_input_color\" size=\"40\" type=\"text\" name=\"ed_addr2\" value=\"".stripcslashes($row["addr2"])."\">");
	$text .= dtcFormLineDraw( _("Address (line3): ") ,"<input class=\"dtcDatagrid_input_alt_color\" size=\"40\" type=\"text\" name=\"ed_addr3\" value=\"".stripcslashes($row["addr3"])."\">",0);
	$text .= dtcFormLineDraw( _("City: ") ,"<input class=\"dtcDatagrid_input_color\" size=\"40\" type=\"text\" name=\"ed_city\" value=\"".stripcslashes($row["city"])."\">");
	$text .= dtcFormLineDraw( _("Zipcode: ") ,"<input class=\"dtcDatagrid_input_alt_color\" size=\"40\" type=\"text\" name=\"ed_zipcode\" value=\"".stripcslashes($row["zipcode"])."\">",0);
	$text .= dtcFormLineDraw( _("State: ") ,"<input class=\"dtcDatagrid_input_color\" size=\"40\" type=\"text\" name=\"ed_state\" value=\"".stripcslashes($row["state"])."\">");
	$text .= dtcFormLineDraw( _("Country: ") ,"<select class=\"dtcDatagrid_input_alt_color\" name=\"ed_country\">".
cc_code_popup($row["country"])."</select>",0);
	$text .= dtcFormLineDraw( _("Phone number: ") ,"<input class=\"dtcDatagrid_input_color\" size=\"40\" type=\"text\" name=\"ed_phone\" value=\"".stripcslashes($row["phone"])."\">");
	$text .= dtcFormLineDraw( _("Fax: ") ,"<input class=\"dtcDatagrid_input_alt_color\" size=\"40\" type=\"text\" name=\"ed_fax\" value=\"".stripcslashes($row["fax"])."\">",0);
	$text .= dtcFormLineDraw( _("Email: ") ,"<input class=\"dtcDatagrid_input_color\" size=\"40\" type=\"text\" name=\"ed_email\" value=\"".$row["email"]."\">");
	$text .= dtcFormLineDraw( _("Notes: ") ,"<textarea class=\"dtcDatagrid_input_alt_color\" cols=\"40\" rows=\"5\" name=\"ed_special_note\">".stripcslashes($specnot)."</textarea>",0);
	$text .= dtcFormLineDraw( _("Money remaining: ") ,"<input class=\"dtcDatagrid_input_color\" size=\"40\" type=\"text\" name=\"ed_dollar\" value=\"".$row["dollar"]."\">");
	$text .= dtcFormLineDraw( _("Quota (MB): ") ,"<input class=\"dtcDatagrid_input_alt_color\" size=\"40\" type=\"text\" name=\"ed_disk_quota_mb\" value=\"".$row["disk_quota_mb"]."\">",0);
	$text .= dtcFormLineDraw( _("Allowed data transfer (GB): ") ,"<input class=\"dtcDatagrid_input_color\" size=\"40\" type=\"text\" name=\"ed_bw_quota_per_month_gb\" value=\"".$row["bw_quota_per_month_gb"]."\">");

	$text .= "
<tr><td align=\"right\"></td><td><div class=\"input_btn_container\" onMouseOver=\"this.className='input_btn_container-hover';\" onMouseOut=\"this.className='input_btn_container';\">
 <div class=\"input_btn_left\"></div>
 <div class=\"input_btn_mid\"><input class=\"input_btn\" type=\"submit\" value=\"Save\"></div>
 <div class=\"input_btn_right\"></div>
</div></form>
<form><form action=\"".$_SERVER["PHP_SELF"]."\">
<input type=\"hidden\" name=\"rub\" value=\"crm\">
<input type=\"hidden\" name=\"delete_id\" value=\"$cid\">
<input type=\"hidden\" name=\"action\" value=\"delete_customer_id\">
<input type=\"hidden\" name=\"del\" value=\"Del\">
<div class=\"input_btn_container\" onMouseOver=\"this.className='input_btn_container-hover';\" onMouseOut=\"this.className='input_btn_container';\">
 <div class=\"input_btn_left\"></div>
 <div class=\"input_btn_mid\"><input class=\"input_btn\" type=\"submit\" value=\""._("Delete client")."\"></div>
 <div class=\"input_btn_right\"></div>
</div></td></tr>
</table>
</form>";
	return $text;
}

?>
