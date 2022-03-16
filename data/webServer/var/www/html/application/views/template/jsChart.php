

var <?= $topic.$id ?>Ctx = document.getElementById('<?= $topic.$id ?>Chart');

var <?= $topic.$id ?>Chart = new Chart(<?= $topic.$id ?>Ctx, {
	type: 'scatter',
	data: { datasets: [ {label:'<?= $topic ?>',data: [ ],showLine: true,fill: false, borderColor: '#C00000', backgroundColor: '#C00000'}, ] },
	options: {pointStyle: 'line',tooltips: {mode: 'index',intersect: false,},hover: {mode: 'nearest',intersect: false},scales: {  yAxes: [{ticks: {beginAtZero:true}}]}, animation: false,},
});


function update_<?= $topic.$id ?>Chart()  {
	getDataset('<?= $id ?>', '<?= $topic ?>', <?= $topic.$id ?>Chart, '<?= base_url('Measures'); ?>');
}
update_<?= $topic.$id ?>Chart();
setInterval(update_<?= $topic.$id ?>Chart, 10000);




