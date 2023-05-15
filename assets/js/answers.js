document.addEventListener("DOMContentLoaded", function (event) {
	var answersItens = document.querySelectorAll('.answer-trigger');
	var answersItensFood = document.querySelectorAll('.answer-trigger-food');
	const responseModal = document.getElementById('responseModal');
	
	var modalResponse = new bootstrap.Modal(responseModal, { backdrop: 'static' });
	console.log(modalResponse)
	responseModal.addEventListener('hidden.bs.modal', function () {
		const modalTitle = responseModal.querySelector('.modal-info-title');
		const modalIcon = responseModal.querySelector('.modal-icon');
		modalTitle.innerHTML = '';
		modalIcon.classList.remove(...['fa-times', 'fa-check', 'text-danger', 'text-success']);
	})
	console.log(answersItens)
	answersItens.forEach(function (nps) {
		nps.addEventListener('click', (el) => {
			console.log(el)
			let currentElement;
			if (!el.target.classList.contains('answer-trigger')) {
				let c = false;
				currentElement = el.target;
				while (!c) {
					console.log('Laço')
					if (!currentElement.classList.contains('answer-trigger')) {
						currentElement = currentElement.parentElement;
					} else {
						c = true;
					}

				}
			} else {
				currentElement = el.target;
			}
			console.log(currentElement.dataset);
			const answer = currentElement.dataset.answer;

			console.log(answer);
			makeRequestAnswer(answer,'service')
		})
	});
	answersItensFood.forEach(function (nps) {
		nps.addEventListener('click', (el) => {
			console.log(el)
			let currentElement;
			if (!el.target.classList.contains('answer-trigger-food')) {
				let c = false;
				currentElement = el.target;
				while (!c) {
					console.log('Laço')
					if (!currentElement.classList.contains('answer-trigger-food')) {
						currentElement = currentElement.parentElement;
					} else {
						c = true;
					}

				}
			} else {
				currentElement = el.target;
			}
			console.log(currentElement.dataset);
			const answer = currentElement.dataset.answer;

			console.log(answer);
			makeRequestAnswer(answer,'food')
		})
	});
	function makeRequestAnswer(answer,type) {
		fetch(base_url + '/external/answer/'+type, {
			method: 'POST',
			headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest' },
			body: 'answer=' + answer
		})
			.then(response => response.json())
			.then(response => {
				console.log(response)
				let classIcon = '';
				if (response.error) {
					classIcon = ['fa-times','text-danger'];
				} else {
					classIcon = ['fa-check','text-success'];
				}
				openModalReponse(classIcon, response.msg);
			}).catch((ex) => {
				openModalReponse('fa-times text-warning', 'Não foi possível registrar sua avaliação');
			})
	}

	function openModalReponse(icon, content) {

		const modalTitle = responseModal.querySelector('.modal-info-title');
		const modalIcon = responseModal.querySelector('.modal-icon');

		console.log(modalTitle,modalIcon);

		modalTitle.innerHTML = content;
		modalIcon.classList.add(...icon)

		modalResponse.show();
		setTimeout(() => {
			modalResponse.hide();
		}, 5000);
	}
})
