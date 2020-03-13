var siteUrl = "http://itfive.local/";

function statusSend(id) {
	var status = document.querySelector("#status" + id);

	var ajax = new XMLHttpRequest();
 		ajax.open("POST", "http://itfive.local/admin/options/status/statusNew.php", false);
 		ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
 		ajax.send("id=" + id);

 	// status.innerHTML = ajax.responce;
 	location.reload();
}

function statusNew(id) {
	var status = document.querySelector("#status" + id);

	var ajax = new XMLHttpRequest();
 		ajax.open("POST", "http://itfive.local/admin/options/status/statusSend.php", false);
 		ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
 		ajax.send("id=" + id);

 	// status.innerHTML = ajax.responce;
 	location.reload();
}