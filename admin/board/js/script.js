// // Открыть модальное окно контактов
// var btnOpenContact = document.querySelector("#open-contact");
// 	btnOpenContact.onclick = function() {
// 	var contactsModal = document.querySelector("#contacts-modal");
// 	//closeAllModal();
// 	contactsModal.style.display = "block";
// }
// // Закрыть модальное окно
// var contactsModalBtnClose = document.querySelector("#contacts-modal .close");
// 	contactsModalBtnClose.onclick = function() {
// 	var contactsModal = document.querySelector("#contacts-modal");
// 	contactsModal.style.display = "none";
// }

// function addFriend(element) {
// 	var listFriend = document.querySelector("#list-Friends");
// 	//console.dir(element);
// 	var link = element.dataset.link;
// 	// Создать объект для отправки http запроса
// 	var ajax = new XMLHttpRequest();
// 		// Открываем ссылку, передавая метод запоса и саму ссылку
// 		ajax.open("GET", link, false);
// 		// Отправляем запрос
// 		ajax.send();
// 	// меняем контент в блоке #list-Friends
// 	listFriend.innerHTML = ajax.response;
// }

// function deleteFriend(element) {
// 	var listFriend = document.querySelector("#list-Friends");
// 	//console.dir(element);
// 	var link = element.dataset.link;
// 	// Создать объект для отправки http запроса
// 	var ajax = new XMLHttpRequest();
// 		// Открываем ссылку, передавая метод запоса и саму ссылку
// 		ajax.open("GET", link, false);
// 		// Отправляем запрос
// 		ajax.send();
// 	// меняем контент в блоке #list-Friends
// 	listFriend.innerHTML = ajax.response;
// }

var form = document.querySelector("#form");
	//console.dir(form);
	form.onsubmit = function(event) {
	event.preventDefault();

	var task_id = form.querySelector("input[name='task_id']");
	var user_id = form.querySelector("input[name='user_id']");
	var comment = form.querySelector("textarea");
	console.dir(comment);

	var data = 	"comment=1" +
					"&task_id=" + task_id.value +
					"&user_id=" + user_id.value +
					"&comment=" + comment.value;

	// Создать объект для отправки http запроса
	var ajax = new XMLHttpRequest();
		// Открываем ссылку, передавая метод запоса и саму ссылку
		ajax.open("POST", form.action, false);
		// Отправляем запрос
		ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		// Отправляем запрос
		ajax.send(data);
		console.dir(ajax);

		var listComments = document.querySelector("#list-comments");
			listComments.innerHTML = ajax.response;
			comment.value = null;
}


// var formSearch = document.querySelector("#search");
// 	//console.dir(form);
// 	formSearch.onsubmit = function(event) {
// 	event.preventDefault();

// 	var searchText = formSearch.querySelector("input[name='search-text']");


// 	var data = 	"searchName=1" +
// 					"&search-text=" + searchText.value;


// 	// Создать объект для отправки http запроса
// 	var ajax = new XMLHttpRequest();
// 		// Открываем ссылку, передавая метод запоса и саму ссылку
// 		ajax.open("POST", formSearch.action, false);
// 		// Отправляем запрос
// 		ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
// 		// Отправляем запрос
// 		ajax.send(data);
// 		console.dir(ajax);

// 		var listContacts = document.querySelector("#list-contacts");
// 			listContacts.innerHTML = ajax.response;
// }

