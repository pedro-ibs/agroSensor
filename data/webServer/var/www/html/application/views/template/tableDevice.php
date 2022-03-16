
<tr>
	<th scope="row"><i><?=$fake_id?></i></th>
	<th><i><?=$name?></i></th>
	<th scope="row"><i><?=$mac_address?></i></th>
	<td><i><spam id='<?=$mac_address?>last_measures'></spam ></i></td>
	<td><i><spam id='<?=$mac_address?>status'></spam ></i></td>
	<td><i><spam id='<?=$mac_address?>vcc'></spam ></i></td>
	<td><i><spam id='<?=$mac_address?>vbat'></spam ></i></td>
	<td><a class='btn btn-secondary btn-sm' href='<?=base_url("Dashboard/device/".$id);?>'>Mais</a></td>
</tr>
