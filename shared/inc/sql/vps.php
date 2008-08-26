<?php

function remoteVPSAction($vps_node,$vps_name,$action){
	$soap_client = connectToVPSServer($vps_node);
	if($soap_client === false){
		echo "<font color=\"red\">". _("Could not connect to VPS server!") ."</font>";
		return;
	}
	switch($action){
	case "start_vps":
		$r = $soap_client->call("startVPS",array("vpsname" => "xen".$vps_name),"","","");
		break;
	case "destroy_vps":
		$r = $soap_client->call("destroyVPS",array("vpsname" => "xen".$vps_name),"","","");
		break;
	case "shutdown_vps":
		$r = $soap_client->call("shutdownVPS",array("vpsname" => "xen".$vps_name),"","","");
		break;
	case "kill_vps_disk":
		$r = $soap_client->call("killVPS",array("vpsname" => $vps_name),"","","");
		break;
	default:
		break;
	}
	$err = $soap_client->getError();
	if(!$err){
	//    echo "Result: ".print_r($r);
	}else{
		echo "Error: ".$err;
	}
}

if(isset($_REQUEST["action"]) && ($_REQUEST["action"] == "shutdown_vps" || $_REQUEST["action"] == "destroy_vps" || $_REQUEST["action"] == "start_vps")){
	if(checkVPSAdmin($adm_login,$adm_pass,$vps_node,$vps_name) == true){
		remoteVPSAction($vps_node,$vps_name,$_REQUEST["action"]);
	}else{
		$submit_err = _("Access not granted line ") .__LINE__. _(" file ") .__FILE__;
	}
}
if(isset($_REQUEST["action"]) && ($_REQUEST["action"] == "set_ip_reverse_dns")){
	if(checkVPSAdmin($adm_login,$adm_pass,$vps_node,$vps_name) == true){
		if(!isIP($_REQUEST["ip_addr"])){
			$submit_err = _("This is not a correct IP line ") .__LINE__. _(" file ") .__FILE__;
		}else{
			if(!isHostnameOrIP($_REQUEST["rdns"])){
				$submit_err = _("This is not a correct hostname or IP line ") .__LINE__. _(" file ") .__FILE__;
			}else{
				$q = "SELECT * FROM $pro_mysql_vps_ip_table WHERE ip_addr='".$_REQUEST["ip_addr"]."' AND vps_xen_name='$vps_name' AND vps_server_hostname='$vps_node';";
				$r = mysql_query($q)or die("Cannot query $q line ".__LINE__." file ".__FILE__." sql said: ".mysql_error());
				$n = mysql_num_rows($r);
				if($n != 1){
					$submit_err = _("Access not granted line ") .__LINE__. _(" file ") .__FILE__;
				}else{
					$q = "UPDATE $pro_mysql_vps_ip_table SET rdns_addr='".$_REQUEST["rdns"]."' WHERE ip_addr='".$_REQUEST["ip_addr"]."';";
					$r = mysql_query($q)or die("Cannot query $q line ".__LINE__." file ".__FILE__." sql said: ".mysql_error());
				}
			}
		}
	}else{
		$submit_err = _("Access not granted line ") .__LINE__. _(" file ") .__FILE__;
	}
}

if(isset($_REQUEST["action"]) && $_REQUEST["action"] == "change_xm_console_ssh_passwd"){
	if(!isDTCPassword($_REQUEST["new_password"])){
		$submit_err = _("The password you have submited is not a valid password") ;
		$commit_flag = "no";
	}
	if(checkVPSAdmin($adm_login,$adm_pass,$vps_node,$vps_name) != true){
		$submit_err = _("Access not granted line ") .__LINE__. _(" file ") .__FILE__;
		$commit_flag = "no";
	}
	if($commit_flag == "yes"){
		$soap_client = connectToVPSServer($vps_node);
		if($soap_client === false){
			echo "<font color=\"red\">". _("Could not connect to VPS server!") ."</font>";
			return;
		}
		$r = $soap_client->call("changeVPSxmPassword",array("vpsname" => "xen".$vps_name,"password" => $_REQUEST["new_password"]),"","","");
		$err = $soap_client->getError();
		if(!$err){
		}else{
			echo _("Error: ") .$err;
		}
	}
}

if(isset($_REQUEST["action"]) && $_REQUEST["action"] == "change_xm_console_ssh_key"){
	if(checkVPSAdmin($adm_login,$adm_pass,$vps_node,$vps_name) != true){
		$submit_err = _("Access not granted line ") .__LINE__. _(" file ") .__FILE__;
		$commit_flag = "no";
	}
	if( !isSSHKey($_REQUEST["new_key"])){
		$commit_flag = "no";
		$submit_err = "Need to add the code for checking ssh key string validity!";
	}
	if($commit_flag == "yes"){
		$soap_client = connectToVPSServer($vps_node);
		if($soap_client === false){
			echo "<font color=\"red\">". _("Could not connect to VPS server!") ."</font>";
			return;
		}
		$r = $soap_client->call("changeVPSsshKey",array("vpsname" => "xen".$vps_name,"keystring" => $_REQUEST["new_key"]),"","","");
		$err = $soap_client->getError();
		if(!$err){
		}else{
			echo "Error: ".$err;
		}
	}
}

if(isset($_REQUEST["action"]) && $_REQUEST["action"] == "fsck_vps"){
	if(checkVPSAdmin($adm_login,$adm_pass,$vps_node,$vps_name) != true){
		$submit_err = _("Access not granted line ") .__LINE__. _(" file ") .__FILE__;
		$commit_flag = "no";
	}
	if($commit_flag == "yes"){
		$soap_client = connectToVPSServer($vps_node);
		if($soap_client === false){
			echo "<font color=\"red\">". _("Could not connect to VPS server!") ."</font>";
			return;
		}
		$r = $soap_client->call("fsckVPSpartition",array("vpsname" => "xen".$vps_name),"","","");
	}
}

if(isset($_REQUEST["action"]) && $_REQUEST["action"] == "reinstall_os"){
	if(checkVPSAdmin($adm_login,$adm_pass,$vps_node,$vps_name) != true){
		$submit_err = _("Access not granted line ") .__LINE__. _(" file ") .__FILE__;
		$commit_flag = "no";
	}
	// Os name checking is now more relaxed as this is customizable by the dtc-xen server
	if(!isFtpLogin($_REQUEST["os_type"])){
		$submit_err = "OS type is not corret ".__LINE__." file ".__FILE__;
		$commit_flag = "no";
	}
	$q = "SELECT * FROM $pro_mysql_vps_table WHERE vps_xen_name='$vps_name' AND vps_server_hostname='$vps_node';";
	$r = mysql_query($q)or die("Cannot execute query \"$q\" ! line: ".__LINE__." file: ".__FILE__." sql said: ".mysql_error());
	$n = mysql_num_rows($r);
	if($n != 1){
		$commit_flag = "no";
		$submit_err = _("Cannot get VPS information line ") .__LINE__. _(" file ") .__FILE__;
	}
	$ze_vps = mysql_fetch_array($r);

	// Get all IP addresses
	$q = "SELECT * FROM $pro_mysql_vps_ip_table WHERE vps_xen_name='$vps_name' AND vps_server_hostname='$vps_node' AND available='no';";
	$r = mysql_query($q)or die("Cannot execute query \"$q\" ! line: ".__LINE__." file: ".__FILE__." sql said: ".mysql_error());
	$n = mysql_num_rows($r);
	if($n < 1){
		$commit_flag = "no";
		$submit_err = _("Cannot get VPS IP addresses information line ") .__LINE__. _(" file ") .__FILE__;
	}
	$vps_all_ips = "";
	for($i=0;$i<$n;$i++){
		$iparray = mysql_fetch_array($r);
		if($i == 0){
			$ze_vps_ip = $iparray;
		}else{
			$vps_all_ips .= " ";
		}
		$vps_all_ips .= $iparray["ip_addr"];
	}

	if($commit_flag == "yes"){
		$soap_client = connectToVPSServer($vps_node);
		if($soap_client === false){
			echo "<font color=\"red\">". _("Could not connect to VPS server!") ."</font>";
			return;
		}

		$q = "UPDATE $pro_mysql_vps_table SET operatingsystem='".$_REQUEST["os_type"]."' WHERE vps_xen_name='$vps_name' AND vps_server_hostname='$vps_node';";
		$r = mysql_query($q)or die("Cannot execute query \"$q\" ! line: ".__LINE__." file: ".__FILE__." sql said: ".mysql_error());
		if($_REQUEST["os_type"] != "netbsd"){
		// On this one we pass only "XX" and not "xenXX" as parameter !
			$image_type = "lvm";
			if (isVPSNodeLVMEnabled($vps_node) == "no")
			{
				$image_type = "vbd";	
			}
			$r = $soap_client->call("reinstallVPSos",array(
				"vpsname" => $vps_name,
				"ostype" => $_REQUEST["os_type"],
				"hddsize" => $ze_vps["hddsize"],
				"ramsize" => $ze_vps["ramsize"],
				"ipaddr" => $vps_all_ips,
                                "imagetype" => $image_type),"","","");
		}
	}
}

if(isset($_REQUEST["action"]) && $_REQUEST["action"] == "change_bsd_kernel_type"){
	if(checkVPSAdmin($adm_login,$adm_pass,$vps_node,$vps_name) != true){
		$submit_err = _("Access not granted line ") .__LINE__. _(" file ") .__FILE__;
		$commit_flag = "no";
	}
	switch($_REQUEST["bsdkernel"]){
	case "normal":
	case "install":
		break;
	default:
		$submit_err = _("BSD kernel type is not correct line ") .__LINE__. _(" file ") .__FILE__;
		$commit_flag = "no";
		break;
	}

	$q = "SELECT * FROM $pro_mysql_vps_table WHERE vps_xen_name='$vps_name' AND vps_server_hostname='$vps_node';";
	$r = mysql_query($q)or die("Cannot execute query \"$q\" ! line: ".__LINE__." file: ".__FILE__." sql said: ".mysql_error());
	$n = mysql_num_rows($r);
	if($n != 1){
		$commit_flag = "no";
		$submit_err = _("Cannot get VPS information line ") .__LINE__. _(" file ") .__FILE__;
	}
	$ze_vps = mysql_fetch_array($r);

	// Get all IP addresses
	$q = "SELECT * FROM $pro_mysql_vps_ip_table WHERE vps_xen_name='$vps_name' AND vps_server_hostname='$vps_node' AND available='no';";
	$r = mysql_query($q)or die("Cannot execute query \"$q\" ! line: ".__LINE__." file: ".__FILE__." sql said: ".mysql_error());
	$n = mysql_num_rows($r);
	if($n < 1){
		$commit_flag = "no";
		$submit_err = _("Cannot get VPS IP addresses information line ") .__LINE__. _(" file ") .__FILE__;
	}
	$vps_all_ips = "";
	for($i=0;$i<$n;$i++){
		$iparray = mysql_fetch_array($r);
		if($i == 0){
			$ze_vps_ip = $iparray;
		}else{
			$vps_all_ips .= " ";
		}
		$vps_all_ips .= $iparray["ip_addr"];
	}

	if($commit_flag == "yes"){
		$soap_client = connectToVPSServer($vps_node);
		if($soap_client === false){
			echo "<font color=\"red\">". _("Could not connect to VPS server!") ."</font>";
			return;
		}
		$q = "UPDATE $pro_mysql_vps_table SET bsdkernel='".$_REQUEST["bsdkernel"]."' WHERE vps_xen_name='$vps_name' AND vps_server_hostname='$vps_node';";
		$r = mysql_query($q)or die("Cannot execute query \"$q\" ! line: ".__LINE__." file: ".__FILE__." sql said: ".mysql_error());
		$r = $soap_client->call("changeBSDkernel",array(
			"vpsname" => $vps_name,
			"ramsize" => $ze_vps["ramsize"],
			"kerneltype" => $_REQUEST["bsdkernel"],
			"allipaddrs" => $vps_all_ips),"","","");
	}
}

?>
