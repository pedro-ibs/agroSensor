
function popup_message_close() { document.getElementById("popup_message").style.display	= "none"; }

if (!Date.now) { Date.now = function now() { return new Date().getTime(); }; }

const toTimestamp = (strDate) => {  const dt = new Date(strDate).getTime(); return dt / 1000; } 

function dateUpdate (){
	var dt = new Date(Date.now());
	var year	= dt.getFullYear();
	var month	= dt.getMonth() + 1;
	var day 	= dt.getDate();

	if (month <= 9) {
		month = '0' + month;
	}
	
	if (day <= 9) {
		day = '0' + day;
	}

	var date = year+"-"+month+"-"+day;
	document.getElementById("date").value		= date;
	document.getElementById("date_end").value	= date;
}


function updateChart(repons, chart){
	const chartData = chart.data
	var timeNow = document.getElementById("date").value;
	timeNow = timeNow+" 00:00:00"
	timeNow = toTimestamp(timeNow);

	length = chartData.datasets[0].data.length;
	for (var i = 0; i < length; i++) {
		chartData.datasets[0].data.pop();
	}

	for(var drop in repons){
		var elem = repons[drop];

		var time = toTimestamp(elem.timestamp) - timeNow;
		time = time/(60*60);

		const newData = {x:time, y:elem.payload};
		chartData.datasets[0].data.push(newData);
	}			
	chart.update();

}

function getDataset( id, topic, chart, action ){
	var date = document.getElementById("date").value;
	date = date+" 00:00:00";

	var date_end = document.getElementById("date_end").value;
	date_end = date_end+" 23:59:59";

	$.ajax({
		url:action,
		method:'POST',
		data:{ id: id, topic:topic, date: date, date_end: date_end},
		dataType: 'json',
		success: function(repons) {
			updateChart(repons, chart);
		}, error: function() {

		}			
	});
}

function updateTextTag(tagId, textValue){
	var tag = $('#'+tagId);
	tag.text(textValue);
};


function getTextTag(tagId){
	var str = document.getElementById(tagId).textContent;
	return str;
}


function translateStatus (tagId, value){

	var elem = document.getElementById(tagId);

	if(value == '0'){
		elem.setAttribute('class', 'bg-secondary p-1 rounded-3');
		return 'Desconhecido';
	}

	if(value == '1'){
		elem.setAttribute('class', 'bg-success p-1 rounded-3');
		return 'Conectado';
	}

	if(value == '2'){
		elem.setAttribute('class', 'bg-danger p-1 rounded-3');
		return 'Desconectado';
	}

	if(value == '3'){
		elem.setAttribute('class', 'bg-warning p-1 rounded-3');
		return 'Baretita baixa';
	}

	return value;
}

function updateDeviceInfo(mac_address, labels, action){
	$.ajax({
		url:action,
		method:'POST',
		data:{ mac_address: mac_address},
		dataType: 'json',
		success: function(repons) {
			for(var drop in labels){
				var label = labels[drop];
				var tagId = mac_address+label;
				var value = repons[label];

				if(label == 'status'){
					updateTextTag(tagId, translateStatus(tagId, value));
				} else {
					updateTextTag(tagId, value);
				}

			}

		}, error: function() {

		}			
	});	
}



function download(content, filename, contentType){
	if(!contentType){
	    contentType = 'application/octet-stream';
	}
	
	var a = document.createElement('a');
	var blob = new Blob([content], {'type':contentType});
	
	a.href = window.URL.createObjectURL(blob);
	a.download = filename;
	a.click();
}



function downloadDataset( id, topic, action ){
	var date = document.getElementById("date").value;
	date = date+" 00:00:00";

	var date_end = document.getElementById("date_end").value;
	date_end = date_end+" 23:59:59";

	$.ajax({
		url:action,
		method:'POST',
		data:{ id: id, topic:topic, date: date, date_end: date_end},
		dataType: 'json',
		success: function(repons) {
			const my = JSON.stringify(repons);
			download(my, topic+'.json', "json" );
		}, error: function() {

		}			
	});
}








