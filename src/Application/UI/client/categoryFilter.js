import naja from 'naja';
import onDomReady from './onDomReady';

const initialize = () => {
	const categoryFilter = document.querySelector('.categoryFilter');
	if (categoryFilter !== null) {
		const selectBox = categoryFilter.querySelector('select');
		selectBox.addEventListener('change', (event) => {
			naja.uiHandler.submitForm(event.target.form);
		});

		const submit = categoryFilter.querySelector('input[type="submit"]');
		submit.style.display = 'none';
	}
};

onDomReady(initialize);
