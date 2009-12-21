#!/usr/bin

# Makefile for dtc-common

# Example call parameters:
# make install-dtc-common DESTDIR=/tmp/test_dtc \
# DTC_APP_DIR=/usr/share DTC_GEN_DIR=/var/lib \
# CONFIG_DIR=/etc DTC_DOC_DIR=/usr/share/doc \
# MANUAL_DIR=/usr/share/man

# Version and release are set here:
VERS=0.30.16
RELS=1

VERSION=$(VERS)"-"$(RELS)
CURDIR?=`pwd`

# BSD stuffs
BSD_VERSION=$(VERS).$(RELS)
PKG_BUILD=dtc-$(BSD_VERSION)
BSD_ARCH_NAME=$(PKG_BUILD).tar.gz
BSD_DEST_DIR?=..
BSD_SOURCE_DIR=src/bsd
BSD_BUILD_DIR?=$(BSD_SOURCE_DIR)/tmp
MAIN_PORT_PATH=sysutils/dtc
PORT_BUILD=$(BSD_BUILD_DIR)/$(MAIN_PORT_PATH)
SRC_COPY_DIR=$(CURDIR)/$(BSD_BUILD_DIR)/$(PKG_BUILD)
PKG_PLIST_BUILD=$(CURDIR)/${BSD_BUILD_DIR}/PKG_PLIST_BUILD

INSTALL?=install -D
INSTALL_DIR?=install -d

# Set defaults (as for Debian as normal platform)
DTC_APP_DIR?=/usr/share
DTC_GEN_DIR?=/var/lib
INIT_DIR?=/etc/rc.d/init.d
CONFIG_DIR?=/etc
DTC_DOC_DIR?=/usr/share/doc
MANUAL_DIR?=/usr/share/man
BIN_DIR?=/usr/bin
SBIN_DIR?=/usr/sbin
UNIX_TYPE?=debian

# /usr/share
APP_INST_DIR = $(DESTDIR)$(DTC_APP_DIR)/dtc
# /var/lib
GENFILES_DIRECTORY = $(DESTDIR)$(DTC_GEN_DIR)/dtc
# /etc
DTC_ETC_DIRECTORY = $(DESTDIR)$(CONFIG_DIR)/dtc
# /usr/share/doc
DOC_DIR = $(DESTDIR)$(DTC_DOC_DIR)/dtc
# /usr/share/man
MAN_DIR = $(DESTDIR)$(MANUAL_DIR)
# /usr/bin
BINARY_DIR = $(DESTDIR)$(BIN_DIR)
# /usr/sbin
SBINARY_DIR = $(DESTDIR)$(SBIN_DIR)

PHP_RIGHTS=0644
ROOT_SCRIPTS_RIGHTS=0750
DTC_SCRIPTS_RIGHTS=0755
ROOT_ONLY_READ=0640
NORMAL_FOLDER=0775
MANPAGE_RIGHTS=0644

#there is no prepareDebianTree in bin directory, removed that entry from list as the make debian-packages failed with that

BIN_FOLDER_CONTENT=bin/buildGentoo bin/makeGentoo bin/makeSlackware bin/README.how_to_build_a_pachage \
bin/buildRelease bin/makeOsx bin/makeTarball bin/clean bin/makeDTC bin/makeRedhat bin/sources

BSD_MAKE_PKG_SOURCES=$(BSD_SOURCE_DIR)/php4-dtc-slave  $(BSD_SOURCE_DIR)/proftpd-dtc-slave  $(BSD_SOURCE_DIR)/README.html  \
$(BSD_SOURCE_DIR)/sendpr.template $(BSD_SOURCE_DIR)/dtc/install.sh $(BSD_SOURCE_DIR)/dtc/Makefile $(BSD_SOURCE_DIR)/dtc/pkg-descr  \
$(BSD_SOURCE_DIR)/dtc/pkg-message $(BSD_SOURCE_DIR)/dtc/uninstall.sh $(BSD_SOURCE_DIR)/dtc-postfix-courier/Makefile \
$(BSD_SOURCE_DIR)/dtc-postfix-courier/pkg-descr $(BSD_SOURCE_DIR)/dtc-toaster/Makefile  $(BSD_SOURCE_DIR)/dtc-toaster/pkg-descr

default:
	@echo "******************************************************************"
	@echo "******* Error: there is no default target in this Makefile! ******"
	@echo "******************************************************************"
	@echo "*Please select one of the following targets:                     *"
	@echo "*install-dtc-stats-daemon, install-dtc-common, bsd-ports-packages*"
	@echo "*install-dtc-dos-firewall or make debian-packages                *"
	@echo "*Note that debian users should NOT use make debian-packages      *"
	@echo "*directly, but dpkg-buildpackage that will call it.              *"
	@echo "******************************************************************"
	@echo "and don't forget that you can set the following variables:"
	@echo "DESTDIR="$(DESTDIR)
	@echo "DTC_APP_DIR="$(DTC_APP_DIR)
	@echo "DTC_GEN_DIR="$(DTC_GEN_DIR)
	@echo "CONFIG_DIR="$(CONFIG_DIR)
	@echo "DTC_DOC_DIR="$(DTC_DOC_DIR)
	@echo "MANUAL_DIR="$(MANUAL_DIR)
	@echo "BIN_DIR="$(BIN_DIR)
	@echo "UNIX_TYPE="$(UNIX_TYPE)
	@echo "CURDIR="$(CURDIR)
	@echo "INSTALL="$(INSTALL)
	@echo ""
	@exit 1

all:
	@echo There is nothing to build: dtc is an arch independant package!!!
	exit 0

clean:
	rm -fr $(BSD_BUILD_DIR)
	rm -fr shared/vars/locale

source-copy:
	@if [ -z $(DESTFOLDER) ] ; then echo "Please set DESTFOLDER=" ; exit 1 ; fi
	@echo "-> Copying sources"
	@mkdir -p $(DESTFOLDER)/bin
	@cp -rf admin client doc email etc Makefile shared $(DESTFOLDER)
	@mkdir -p $(DESTFOLDER)/src/bsd/tmp/$(PKG_BUILD)
	@mkdir -p $(DESTFOLDER)/src/bsd/dtc  $(DESTFOLDER)/src/bsd/dtc-postfix-courier $(DESTFOLDER)/src/bsd/dtc-toaster
	@for i in $(BSD_MAKE_PKG_SOURCES) ; do $(INSTALL) -m $(PHP_RIGHTS) $$i $(DESTFOLDER)/$$i ; done
	@cp -rf $(BIN_FOLDER_CONTENT) $(DESTFOLDER)/bin

debian-packages:
	@echo "--- Making debian source package dtc_$(VERS).orig.tar.gz ---"
	@mkdir -p debian/tmp/dtc-$(VERS)
	@echo "-> Copying source package files with make source-copy DESTFOLDER=debian/tmp/dtc-$(VERS)"
	@make source-copy DESTFOLDER=debian/tmp/dtc-$(VERS)
	@echo "-> Creating archive with tar -czf ../../../dtc_$(VERS).orig.tar.gz dtc-$(VERS)"
	@echo "-> --------------------------------"
	@echo "-> Uncomment this to make a release"
	@echo "-> --------------------------------"
	#@cd debian/tmp && tar -czf ../../../dtc_$(VERS).orig.tar.gz dtc-$(VERS) && cd $(CURDIR)
	@echo "-> Deleting temp file"
	@rm -r debian/tmp
	@echo "-> Building the package"
	@dpkg-buildpackage -rfakeroot -sa                                                                                

bsd-ports-packages:
	@echo "--- Making source snapshot $(BSD_ARCH_NAME) ---"
	@mkdir -p $(BSD_BUILD_DIR)
	@echo "-> Copying source package files with make source-copy DESTFOLDER=$(SRC_COPY_DIR)"
	@make source-copy DESTFOLDER=$(SRC_COPY_DIR)
	@cd $(BSD_BUILD_DIR) && tar -czf $(BSD_ARCH_NAME) $(PKG_BUILD) && cd $(CURDIR)
	@if ! [ $(BSD_DEST_DIR) = . -o $(BSD_DEST_DIR) = ./ -o $(BSD_DEST_DIR) = $(CURDIR) ] ; then mv $(BSD_BUILD_DIR)/$(BSD_ARCH_NAME) $(BSD_DEST_DIR)/ ; fi
	@echo " --- Succesfully made BSD source snapshot ${BSD_DEST_DIR}/${BSD_ARCH_NAME} ---"

	@echo " --- Making BSD port tree for version "$BSD_VERSION" ---"
	@echo "===> Creating port files in $(PORT_BUILD)"
	@mkdir -p $(PORT_BUILD)/files						# Make  dtc port dir and copy static files in it
	@sed "s/__VERSION__/$(BSD_VERSION)/" $(BSD_SOURCE_DIR)/dtc/Makefile >$(PORT_BUILD)/Makefile	# Create Makefile with correct port version
	@cp $(BSD_SOURCE_DIR)/dtc/install.sh $(PORT_BUILD)/files/dtc-install.in		# Create package install script
	@chmod 644 $(PORT_BUILD)/files/dtc-install.in
	@cp $(BSD_SOURCE_DIR)/dtc/uninstall.sh $(PORT_BUILD)/files/dtc-deinstall.in		# Create package uninstall script
	@chmod 644 $(PORT_BUILD)/files/dtc-deinstall.in
	@cp $(BSD_SOURCE_DIR)/dtc/pkg-message $(PORT_BUILD)
	@cp $(BSD_SOURCE_DIR)/dtc/pkg-descr $(PORT_BUILD)
	@echo "MD5 ($(BSD_ARCH_NAME)) = "`if [ -e /sbin/md5 ] ; then md5 -r $(BSD_DEST_DIR)/$(BSD_ARCH_NAME) | cut -f1 -d" " ; else md5sum $(BSD_DEST_DIR)/$(BSD_ARCH_NAME) | cut -f1 -d" " ; fi` >$(PORT_BUILD)/distinfo
	@echo "SIZE ($(BSD_ARCH_NAME)) = "`ls -ALln $(BSD_DEST_DIR)/$(BSD_ARCH_NAME) | awk '{print $$5}'` >>$(PORT_BUILD)/distinfo

	@mkdir -p $(PKG_PLIST_BUILD)
	@echo "-> Calling make install-dtc-common to calculate list in $(PKG_PLIST_BUILD)"
	@make install-dtc-common DESTDIR=$(PKG_PLIST_BUILD) DTC_APP_DIR=/usr/local/www DTC_GEN_DIR=/usr/local/var CONFIG_DIR=/usr/local/etc \
		DTC_DOC_DIR=/usr/local/share/doc MANUAL_DIR=/usr/local/man BIN_DIR=/usr/local/bin UNIX_TYPE=bsd 2>&1 >/dev/null
	echo "-> Building list of files"
	@cd $(PKG_PLIST_BUILD) && find . -type f | sed "s/\.\/usr\/local/%%LOCALBASE%%/" | sort -r >../$(MAIN_PORT_PATH)/pkg-plist.tmp && cd $(CURDIR)
	@echo "%%LOCALBASE%%/www/dtc/admin/gfx" >>$(PORT_BUILD)/pkg-plist.tmp
	@echo "%%LOCALBASE%%/www/dtc/shared/mysql_config.php" >>$(PORT_BUILD)/pkg-plist.tmp
	@echo "%%LOCALBASE%%/www/dtc/client/gfx" >>$(PORT_BUILD)/pkg-plist.tmp
	@echo "sbin/dtc-install" >>$(PORT_BUILD)/pkg-plist.tmp
	@echo "sbin/dtc-deinstall" >>$(PORT_BUILD)/pkg-plist.tmp
	@echo "%%LOCALBASE%%/dtc/email/gfx" >>$(PORT_BUILD)/pkg-plist.tmp
	@cd $(PKG_PLIST_BUILD) && find usr/local -type d -exec echo @dirrm {} \; | grep -v "/etc" | sed "s/usr\/local/%%LOCALBASE%%/" | sort -r >>../$(MAIN_PORT_PATH)/pkg-plist.tmp && cd $(CURDIR)
	@NBR_LINE=`cat $(PORT_BUILD)/pkg-plist.tmp | wc -l` && cat $(PORT_BUILD)/pkg-plist.tmp | head -n $$(( $$NBR_LINE - 2 )) >$(PORT_BUILD)/pkg-plist.tmp2
	@cat $(PORT_BUILD)/pkg-plist.tmp2 | grep -v "mysql_config.php" >$(PORT_BUILD)/pkg-plist
	@echo "@dirrm %%DTCROOT%%/etc/zones" >>$(PORT_BUILD)/pkg-plist
	@echo "@dirrm %%DTCROOT%%/etc" >>$(PORT_BUILD)/pkg-plist
	@echo "@dirrm %%DTCROOT%%" >>$(PORT_BUILD)/pkg-plist
	@rm $(PORT_BUILD)/pkg-plist.tmp $(PORT_BUILD)/pkg-plist.tmp2
	@rm -r $(PKG_PLIST_BUILD)

	@echo "-> Adding slave ports to the archive"
	@mkdir -p $(BSD_BUILD_DIR)/sysutils/dtc-postfix-courier
	@cp $(BSD_SOURCE_DIR)/dtc-postfix-courier/Makefile $(BSD_BUILD_DIR)/sysutils/dtc-postfix-courier
	@cp $(BSD_SOURCE_DIR)/dtc-postfix-courier/pkg-descr $(BSD_BUILD_DIR)/sysutils/dtc-postfix-courier
	@mkdir -p $(BSD_BUILD_DIR)/sysutils/dtc-toaster
	@cp $(BSD_SOURCE_DIR)/dtc-toaster/Makefile $(BSD_BUILD_DIR)/sysutils/dtc-toaster
	@cp $(BSD_SOURCE_DIR)/dtc-toaster/pkg-descr $(BSD_BUILD_DIR)/sysutils/dtc-toaster

	@echo "===> Creating archive file"
	cd $(BSD_BUILD_DIR) && tar -czf dtcBSDport-$(BSD_VERSION).tar.gz sysutils && cd $(CURDIR)
	@mv $(BSD_BUILD_DIR)/dtcBSDport-"$(BSD_VERSION)".tar.gz $(BSD_DEST_DIR)
	@echo "--- Successfully made BSD port tree $(BSD_DEST_DIR)/dtcBSDport-$(BSD_VERSION).tar.gz ---"
	@echo "===> Deleting temp files"
	rm -r $(BSD_BUILD_DIR)



############# PHP SCRIPTS ##############
# Owned by root, but executable by dtc user (ran by apache)
ADMIN_ROOTFOLDER_PHP_SCRIPT_FILES=admin/404.php admin/bw_per_month.php admin/index.php admin/cpugraph.php admin/mailgraph.php admin/deamons_state.php \
admin/view_waitingusers.php admin/memgraph.php admin/netusegraph.php admin/vps_stats_cpu.php \
admin/vps_stats_hdd.php admin/vps_stats_network.php admin/vps_stats_swap.php admin/patch_saslatuhd_startup admin/dtc_db.php admin/dkfilter.patch \
admin/logPushlet.php admin/xanjaxXHR.js admin/authme.php admin/active_prods_graph.php

ADMIN_GENFILE_PHP_SCRIPT_FILES=admin/genfiles/gen_awstats.php admin/genfiles/gen_postfix_email_account.php admin/genfiles/gen_perso_vhost.php \
admin/genfiles/gen_postfix_email_account.php admin/genfiles/gen_backup_script.php admin/genfiles/gen_pro_vhost.php \
admin/genfiles/gen_qmail_email_account.php admin/genfiles/gen_email_account.php admin/genfiles/genfiles.php \
admin/genfiles/gen_ssh_account.php admin/genfiles/gen_maildrop_userdb.php admin/genfiles/gen_webalizer_stat.php \
admin/genfiles/remote_mail_list.php admin/genfiles/gen_named_files.php admin/genfiles/gen_fetchmail.php \
admin/genfiles/mailfilter_vacation_template admin/genfiles/gen_nagios.php

ADMIN_INC_PHP_SCRIPT_FILES=admin/inc/renewals.php \
admin/inc/draw_user_admin.php admin/inc/dtc_config.php \
admin/inc/monitor.php admin/inc/submit_root_querys.php admin/inc/graphs.php admin/inc/nav.php \
admin/dtcrm/main.php admin/dtcrm/product_manager.php admin/dtcrm/submit_to_sql.php

# Todo: have the client/vps_stats_* be taken from the admin folder!
ADMIN_AND_CLIENT_FILES=vps_stats_cpu.php vps_stats_hdd.php vps_stats_network.php vps_stats_swap.php vm-cpu.php vm-io.php vm-net.php \
vm-cpu-all.php vm-io-all.php vm-net-all.php

CLIENT_PHP_SCRIPT_FILES=client/bw_per_month.php client/dynip.php client/enets-notify.php client/index.php \
client/invoice.php client/list_domains.php client/login.php client/new_account_form.php client/new_account.php \
client/new_account_renewal.php client/paypal.php client/secpaycallback_worldpay.php client/webmoney.php \
client/get_vps_location_status.php client/moneybookers.php \
client/logPushlet.php client/xanjaxXHR.js client/cheques_and_transfers.php client/recover_pass.php

EMAIL_PHP_SCRIPT_FILES=email/api.php email/index.php email/login.php email/submit_to_sql_dtcemail.php

SHARED_PHP_SCRIPT_FILES=shared/autoSQLconfig.php shared/cyradm.php shared/default_admin_site.php shared/dtc_lib.php \
shared/dtc_stats_index.php shared/404_template/404.php shared/404_template/406.php shared/404_template/expired.php \
shared/404_template/index.php shared/drawlib/anotherDtc.php shared/drawlib/cc_code_popup.php shared/drawlib/dtc_functions.php \
shared/drawlib/skinLib.php shared/drawlib/skin.php shared/drawlib/templates.php shared/drawlib/tree_menu.php \
shared/dtcrm/draw_adddomain.php shared/dtcrm/draw_handle.php shared/dtcrm/draw_nameservers.php shared/dtcrm/draw.php shared/dtcrm/draw_register_forms.php \
shared/dtcrm/draw_transferdomain.php shared/dtcrm/draw_whois.php shared/dtcrm/opensrs.php shared/dtcrm/registry_calls.php \
shared/dtcrm/RENAME_ME_srs_config.php shared/dtcrm/srs_base.php shared/dtcrm/srs_nameserver.php shared/dtcrm/srs_registernames.php \
shared/dtcrm/submit_to_sql.php shared/dtcrm/srs/country_codes.php shared/dtcrm/srs/openSRS_base.php \
shared/dtcrm/srs/openSRS.php shared/dtcrm/srs/ops.dtd shared/dtcrm/srs/OPS.php shared/dtcrm/srs/test.php shared/dtcrm/srs/test.xml \
shared/dtcrm/webnic.cc/domainQuery.php shared/dtcrm/webnic.cc/domainRegistration.php shared/dtcrm/webnic.cc/test.php \
shared/dtcrm/webnic.cc/webnic_base.php shared/dtcrm/webnic.cc/webnic_settings.php shared/dtcrm/webnic.cc/webnic_submit.php \
shared/template/index.php shared/vars/clear_lang_array.php shared/vars/global_vars.php shared/inc/HTTPRequestClass.php \
shared/vars/lang.php shared/vars/table_names.php shared/visitors_template/visitors.php

SHARED_INC_PHP_SCRIPT_FILES=shared/inc/accounting.php shared/inc/dbconect.php shared/inc/delete_user.php shared/inc/domain_export.php \
shared/inc/draw.php shared/inc/fetchmail.php shared/inc/fetch.php shared/inc/nusoap.php shared/inc/skin.class.php \
shared/inc/submit_to_sql.php shared/inc/tree_mem_to_db.php shared/inc/vps.php shared/inc/forms/vps_monitoring.php shared/inc/forms/vps_graphs.php \
shared/inc/forms/vps_installation.php shared/inc/forms/admin_stats.php \
shared/inc/forms/aliases.php shared/inc/forms/database.php shared/inc/forms/dedicated.php \
shared/inc/forms/dns.php shared/inc/forms/domain_info.php shared/inc/forms/domain_stats.php shared/inc/forms/email.php \
shared/inc/forms/ftp.php shared/inc/forms/invoices.php shared/inc/forms/lists.php \
shared/inc/forms/my_account.php shared/inc/forms/packager.php shared/inc/forms/reseller.php shared/inc/forms/root_admin.php \
shared/inc/forms/ssh.php shared/inc/forms/subdomain.php shared/inc/forms/ticket.php \
shared/inc/forms/tools.php shared/inc/forms/vps.php shared/inc/forms/vps_dom0graphs.php \
shared/inc/sql/database.php shared/inc/sql/dedicated.php \
shared/inc/sql/dns.php shared/inc/sql/domain_info.php \
shared/inc/sql/domain_stats.php shared/inc/sql/email.php \
shared/inc/sql/lists.php shared/inc/sql/reseller.php shared/inc/sql/ssh.php \
shared/inc/sql/subdomain.php shared/inc/sql/ticket.php \
shared/inc/sql/vps.php

SKIN_STUFF=shared/gfx/skin/default_layout.php shared/gfx/skin/bwoup/layout.php

PAYMENT_API_PHP_SCRIPT_FILES=shared/maxmind/CreditCardFraudDetection.php shared/maxmind/HTTPBase.php \
shared/maxmind/LocationVerification.php shared/maxmind/TelephoneVerification.php \
shared/securepay/pay_functions.php \
shared/securepay/modules/enets/main.php \
shared/securepay/modules/paypal/main.php \
shared/securepay/modules/worldpay/main.php \
shared/securepay/modules/cheque/main.php \
shared/securepay/modules/wiretransfer/main.php \
shared/securepay/modules/webmoney/main.php \
shared/securepay/modules/moneybookers/main.php

WEB_SCRIPT_FILES=$(ADMIN_ROOTFOLDER_PHP_SCRIPT_FILES) $(ADMIN_GENFILE_PHP_SCRIPT_FILES) $(ADMIN_INC_PHP_SCRIPT_FILES) \
$(CLIENT_PHP_SCRIPT_FILES) $(EMAIL_PHP_SCRIPT_FILES) $(SHARED_PHP_SCRIPT_FILES) $(SHARED_INC_PHP_SCRIPT_FILES) \
$(PAYMENT_API_PHP_SCRIPT_FILES)

################ PICTURES ##################
NEW_SITES_TEMPLATE_IMG=shared/template/dtc_logo.gif shared/template/dtclogo.png shared/template/favicon.ico shared/template/logo_dtc.gif

CLIENT_PICTURES=client/enets_pay_icon.gif client/favicon.ico client/cheque.gif client/wire.gif client/moneybookers.gif

ALL_PICS=$(NEW_SITES_TEMPLATE_IMG) $(CLIENT_PICTURES)
################# EXECUTABLE SCRIPTS #################
# Owned by root, ran by root
ROOT_CRON_PHP_SCRIPT_FILES=admin/cron.php admin/reminders.php admin/restor_db.php admin/backup_db.php admin/stat_total_active_prods.php admin/support-receive.php
# Owned by root, executed as DTC
DTC_CRON_PHP_SCRIPT_FILES=admin/accesslog.php admin/maint_apache.php
# Owned by root, executed by root
DTC_CRON_SH_SCRIPT_FILES=admin/checkbind.sh
# Ran as dtc user by the php scripts
DTC_WEB_SH_SCRIPT=admin/ip_change.sh admin/genfiles/change_debconf_domain.sh admin/genfiles/change_debconf_ip.sh \
admin/genfiles/gen_customer_ssl_cert.sh

# Ran as root, by the cron job
ROOT_CRON_SH_SCRIPT_FILES=admin/rrdtool.sh admin/updateChroot.sh admin/queuegraph/count_postfix.sh admin/queuegraph/count_qmail.sh \
admin/queuegraph/createrrd.sh admin/cpugraph/createrrd.sh admin/cpugraph/get_cpu_load.sh admin/memgraph/createrrd.sh \
admin/memgraph/get_meminfo.sh admin/netusegraph/createrrd.sh admin/netusegraph/get_net_usage.sh admin/create_stat_total_active_prods_rrd.sh

OTHER_SCRIPT_FILES=admin/sa-wrapper admin/dtc-chroot-shell

ROOT_ONLY=$(ROOT_CRON_SH_SCRIPT_FILES) $(ROOT_CRON_PHP_SCRIPT_FILES)
USER_ALSO=$(DTC_CRON_PHP_SCRIPT_FILES) $(DTC_CRON_SH_SCRIPT_FILES) $(DTC_WEB_SH_SCRIPT) $(OTHER_SCRIPT_FILES)

INSTALL_FOLDER_SCRIPTS=admin/install/mk_root_mailbox.php admin/install/bsd_config admin/install/gentoo_config admin/install/slack_config \
admin/install/debian_config admin/install/install admin/install/osx_config admin/install/uninstall admin/install/functions \
admin/install/interactive_installer admin/install/redhat_config

PATCH_FILES=admin/patches/phpmyadmin_cookie.auth.lib.php.patch admin/patches/spamassassin_default_start.patch admin/patches/phpmyadmin_htaccess.patch \
admin/postfix_checks/body_checks admin/postfix_checks/relaying_stoplist admin/postfix_checks/header_checks admin/postfix_checks/mime_header_checks \
admin/mod-security/modsecurity_crs_10_config.conf admin/mod-security/modsecurity_crs_20_protocol_violations.conf \
admin/mod-security/modsecurity_crs_21_protocol_anomalies.conf admin/mod-security/modsecurity_crs_23_request_limits.conf \
admin/mod-security/modsecurity_crs_30_http_policy.conf admin/mod-security/modsecurity_crs_35_bad_robots.conf \
admin/mod-security/modsecurity_crs_40_generic_attacks.conf admin/mod-security/modsecurity_crs_45_trojans.conf \
admin/mod-security/modsecurity_dtc_web_apps.conf
                                                                        
##################### SQL TABLES #########################
INSTALL_SQL_TABLES=admin/tables/admin.sql admin/tables/backup.sql admin/tables/clients.sql admin/tables/commande.sql \
admin/tables/companies.sql admin/tables/completedorders.sql admin/tables/config.sql admin/tables/cron_job.sql admin/tables/dedicated.sql \
admin/tables/dedicated_ip.sql admin/tables/ip_pool.sql admin/tables/affiliate_payments.sql admin/tables/vps_server_lists.sql \
admin/tables/domain.sql admin/tables/email_accouting.sql admin/tables/fetchmail.sql admin/tables/freeradius.sql \
admin/tables/ftp_access.sql admin/tables/ftp_accounting.sql admin/tables/ftp_logs.sql admin/tables/groups.sql admin/tables/handle.sql \
admin/tables/http_accounting.sql admin/tables/invoicing.sql admin/tables/ip_port_service.sql admin/tables/mailaliasgroup.sql \
admin/tables/mailinglist.sql admin/tables/nameservers.sql admin/tables/new_admin.sql admin/tables/paiement.sql \
admin/tables/pending_queries.sql admin/tables/pending_renewal.sql admin/tables/pop_access.sql admin/tables/product.sql \
admin/tables/scheduled_updates.sql admin/tables/secpayconf.sql admin/tables/smtp_logs.sql admin/tables/ssh_access.sql \
admin/tables/ssh_groups.sql admin/tables/ssh_user_group.sql admin/tables/ssl_ips.sql admin/tables/subdomain.sql \
admin/tables/tik_admins.sql admin/tables/tik_cats.sql admin/tables/tik_queries.sql admin/tables/vps_ip.sql admin/tables/vps_server.sql \
admin/tables/vps.sql admin/tables/vps_stats.sql admin/tables/whitelist.sql admin/tables/whois.sql \
admin/tables/spent_moneyout.sql  admin/tables/spent_providers.sql  admin/tables/spent_type.sql admin/tables/spent_bank.sql

##################### ETC FILES #########################
CREATE_DIRS=admin/inc admin/genfiles admin/dtcrm admin/queuegraph admin/memgraph admin/netusegraph admin/cpugraph admin/install admin/tables \
shared/gfx/menu shared/gfx/bar shared/gfx/skin/bwoup/gfx/buttons shared/gfx/dtc shared/gfx/pagetop \
shared/gfx/securepay shared/gfx/language/en/pub shared/gfx/language/fr/pub shared/gfx/language/ru/pub shared/gfx/language/nl/pub \
shared/gfx/skin/bwoup/gfx/config-icon shared/gfx/skin/bwoup/gfx/buttons shared/gfx/skin/bwoup/gfx/tabs \
shared/gfx/skin/bwoup/gfx/treeview shared/gfx/skin/bwoup/gfx/navbar shared/inc/forms shared/inc/sql shared/404_template shared/drawlib \
shared/dtcrm/srs shared/dtcrm/webnic.cc shared/vars shared/visitors_template shared/template shared/maxmind \
admin/patches shared/securepay/modules shared/securepay/modules/paypal shared/securepay/modules/enets shared/securepay/modules/webmoney \
shared/securepay/modules/worldpay

LOCALE_TRANS=fr_FR hu_HU it_IT nl_NL ru_RU de_DE zh_CN pl_PL sv_SE pt_PT pt_BR es_ES fi_FI zh_TW sr_RS lv_LV

l12n:
	@echo "===> Managing localizations binaries"
	@echo "=> Creating l12n folders"
	@for i in $(LOCALE_TRANS) ; do mkdir -p shared/vars/locale/$$i/LC_MESSAGES ; done
	@echo "=> Creating l12n binaries"
	@cd shared/vars && for i in $(LOCALE_TRANS) ; do echo -n $$i" " ; msgfmt -c -v -o locale/$$i/LC_MESSAGES/messages.mo $$i.po ; done && cd ../..

i18n:
	@echo "===> Managing internationalizations and localizations"
	@echo "=> Extracting strings from sources"
	@xgettext --output-dir=shared/vars $(WEB_SCRIPT_FILES) $(SKIN_STUFF) -o templates.pot
	@echo "=> Merging in every language .po file: "
	@cd shared/vars && for i in $(LOCALE_TRANS) ; do echo -n $$i" " ; msgmerge -s -U $$i.po templates.pot ; done && cd ../..
	@echo "=> Creating l12n folders"
	@for i in $(LOCALE_TRANS) ; do mkdir -p shared/vars/locale/$$i/LC_MESSAGES ; done
	@echo "=> Creating binary formats of language files: "
	@cd shared/vars && for i in $(LOCALE_TRANS) ; do echo -n $$i" " ; msgfmt -c -v -o locale/$$i/LC_MESSAGES/messages.mo $$i.po ; done && cd ../..

install-dtc-stats-daemon:
	if [ $(UNIX_TYPE) = redhat ] ; then \
		$(INSTALL) -m 0755 etc/init.d/dtc-stats-daemon $(DESTDIR)$(INIT_DIR)/dtc-stats-daemon ; \
		$(INSTALL) -m $(ROOT_SCRIPTS_RIGHTS) admin/dtc-stats-daemon.php $(SBINARY_DIR)/dtc-stats-daemon ; \
	else \
		$(INSTALL) -m $(ROOT_SCRIPTS_RIGHTS) admin/dtc-stats-daemon.php $(APP_INST_DIR)/admin/dtc-stats-daemon.php ; \
	fi
	$(INSTALL) -m 0644 etc/logrotate.d/dtc-stats-daemon $(DESTDIR)$(CONFIG_DIR)/logrotate.d/dtc-stats-daemon

install-dtc-dos-firewall:
	$(INSTALL) -m 0644 etc/dtc/dtc-dos-firewall.conf $(DESTDIR)$(CONFIG_DIR)/dtc/dtc-dos-firewall.conf
	if [ $(UNIX_TYPE) = "redhat" ] ; then \
		$(INSTALL) -m 0755 etc/init.d/dtc-dos-firewall $(DESTDIR)$(INIT_DIR) ; fi

install-dtc-common:
	# PHP scripts files served by web server
	@echo "-> Creating destination folders"
	for i in $(CREATE_DIRS) ; do $(INSTALL_DIR) -m $(NORMAL_FOLDER) $(APP_INST_DIR)/$$i ; done
	$(INSTALL_DIR) -m $(NORMAL_FOLDER) $(MAN_DIR)/man8

	@ echo "-> Installing scripts"
	@for i in $(WEB_SCRIPT_FILES) ; do $(INSTALL) -m $(PHP_RIGHTS) $$i $(APP_INST_DIR)/$$i ; done
	@echo "<?php \$$conf_dtc_version=\""$(VERS)"\"; \$$conf_dtc_release=\""$(RELS)"\"; \$$conf_unix_type=\""$(UNIX_TYPE)"\"; ?>" >$(APP_INST_DIR)/shared/dtc_version.php
	@for i in $(PATCH_FILES) ; do $(INSTALL) -m $(PHP_RIGHTS) $$i $(APP_INST_DIR)/$$i ; done

	# Management scripts that are executed
	@for i in $(ROOT_ONLY) ; do $(INSTALL) -m $(ROOT_SCRIPTS_RIGHTS) $$i $(APP_INST_DIR)/$$i ; done
	@for i in $(USER_ALSO) ; do $(INSTALL) -m $(DTC_SCRIPTS_RIGHTS) $$i $(APP_INST_DIR)/$$i ; done
	@for i in $(INSTALL_FOLDER_SCRIPTS) ; do $(INSTALL) -m $(ROOT_SCRIPTS_RIGHTS) $$i $(APP_INST_DIR)/$$i ; done

	@for i in $(ADMIN_AND_CLIENT_FILES) ; do $(INSTALL) -m $(PHP_RIGHTS) admin/$$i $(APP_INST_DIR)/admin/$$i ; done
	@for i in $(ADMIN_AND_CLIENT_FILES) ; do $(INSTALL) -m $(PHP_RIGHTS) admin/$$i $(APP_INST_DIR)/client/$$i ; done

	# The SQL table scripts
	@for i in $(INSTALL_SQL_TABLES) ; do $(INSTALL) -m $(ROOT_ONLY_READ) $$i $(APP_INST_DIR)/$$i ; done

	# The man pages
	$(INSTALL) -m $(MANPAGE_RIGHTS) doc/dtc-chroot-shell.8		$(MAN_DIR)/man8/dtc-chroot-shell.8

	# Client and email inc png files
	@for i in $(ALL_PICS) ; do $(INSTALL) -m $(PHP_RIGHTS) $$i $(APP_INST_DIR)/$$i ; done

	# Copy all the graphics...
	@$(INSTALL) -m $(PHP_RIGHTS) shared/404_template/logo.png $(APP_INST_DIR)/shared/404_template/logo.png
	find shared/gfx -iname '*.png' -exec $(INSTALL) -m $(PHP_RIGHTS) {} $(APP_INST_DIR)/{} \;
	find shared/gfx -iname '*.gif' -exec $(INSTALL) -m $(PHP_RIGHTS) {} $(APP_INST_DIR)/{} \;
	find shared/gfx -iname '*.js' -exec $(INSTALL) -m $(PHP_RIGHTS) {} $(APP_INST_DIR)/{} \;
	find shared/gfx -iname '*.php' -exec $(INSTALL) -m $(PHP_RIGHTS) {} $(APP_INST_DIR)/{} \;
	find shared/gfx -iname '*.html' -exec $(INSTALL) -m $(PHP_RIGHTS) {} $(APP_INST_DIR)/{} \;
	find shared/gfx -iname '*.css' -exec $(INSTALL) -m $(PHP_RIGHTS) {} $(APP_INST_DIR)/{} \;
	[ -h $(APP_INST_DIR)/admin/gfx ] || ln -s ../shared/gfx	$(APP_INST_DIR)/admin/gfx
	[ -h $(APP_INST_DIR)/client/gfx ] || ln -s ../shared/gfx	$(APP_INST_DIR)/client/gfx
	[ -h $(APP_INST_DIR)/email/gfx ] || ln -s ../shared/gfx	$(APP_INST_DIR)/email/gfx

	# Set the stuffs for the logrotate
	mkdir -p $(DESTDIR)$(CONFIG_DIR)/logrotate.d
	$(INSTALL) -m 0644 etc/logrotate.d/dtc $(DESTDIR)$(CONFIG_DIR)/logrotate.d/dtc
	[ -h $(DESTDIR)$(CONFIG_DIR)/logrotate.d/dtc-vhosts ] || ln -s $(DTC_GEN_DIR)/dtc/etc/logrotate $(DESTDIR)$(CONFIG_DIR)/logrotate.d/dtc-vhosts

	# Setup the cron
	mkdir -p $(DESTDIR)$(CONFIG_DIR)/cron.d
	$(INSTALL) -m 0644 etc/cron.d/dtc $(DESTDIR)$(CONFIG_DIR)/cron.d/dtc

	# Create the variables directory
	$(INSTALL) -m $(NORMAL_FOLDER) -d $(GENFILES_DIRECTORY)/etc/zones $(GENFILES_DIRECTORY)/etc/slave_zones 

	# Create the configuration folder
	mkdir -p $(DTC_ETC_DIRECTORY)
	cp -auxf etc/dtc/* $(DTC_ETC_DIRECTORY)
	rm $(DTC_ETC_DIRECTORY)/dtc-dos-firewall.conf

	# Doc dir
	$(INSTALL) -m $(NORMAL_FOLDER) -d $(DOC_DIR)
	if [ $(DTC_DOC_DIR) = "/usr/share/doc" -a $(DTC_APP_DIR) = "/usr/share" ] ; then \
		if [ ! -h $(APP_INST_DIR)/doc ] ; then \
			ln -s ../doc/dtc $(APP_INST_DIR)/doc ; \
		else \
			if [ -h $(APP_INST_DIR)/doc ] ; then \
				ln -s $(DOC_DIR) $(APP_INST_DIR)/doc ; \
			fi ; \
		fi ; \
	fi
	cp -rf doc/* $(DOC_DIR)

	# Copy the internationnalization stuff
	make l12n
	cd shared/vars && cp -rf locale $(APP_INST_DIR)/shared/vars && cd ../..

	rm -rf $(DOC_DIR)/LICENSE
	rm -rf $(DOC_DIR)/LICENSE.gz

dist:
	./dist

deb:
	if [ -z $(SIGN)"" ] ; then \
		./deb ; \
	else \
		./deb --sign ; \
	fi

rpm:
	$(MAKE) dist
	VERS=`head -n 1 debian/changelog | cut -d'(' -f2 | cut -d')' -f1 | cut -d'-' -f1` ; \
	cd .. ; rpmbuild -ta dtc-core-$${VERS}.tar.gz

.PHONY: clean dist rpm install-dtc-common install-dtc-dos-firewall install-dtc-stats-daemon i18n l12n bsd-ports-packages debian-packages deb
