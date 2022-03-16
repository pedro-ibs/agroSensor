function update_<?= $mac_address ?>_info(){
	var labels = ['last_measures', 'vcc', 'vbat', 'status'];
	updateDeviceInfo('<?= $mac_address ?>', labels, '<?= base_url('Measures/device'); ?>');
}
update_<?= $mac_address ?>_info();
setInterval(update_<?= $mac_address ?>_info, 10000);