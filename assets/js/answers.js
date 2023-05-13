
var answersItens = document.querySelectorAll('.answer-trigger');
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
		makeRequestAnswer(answer)
	})
});
function makeRequestAnswer(answer) {
	fetch(base_url + '/external/answer', {
		method: 'POST',
		headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With' : 'XMLHttpRequest' },
		body: 'answer=' + answer
	})
		.then(response => response.json())
		.then(response => {
			console.log(response)
		}).catch((ex)=>{
			console.log('erro',ex)
		})
}
