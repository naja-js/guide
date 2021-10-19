import onDomReady from './onDomReady';

const initialize = () => {
	const categoryFilter = document.querySelector('.categoryFilter');
	if (categoryFilter !== null) {
		const selectBox = categoryFilter.querySelector('select');
		selectBox.addEventListener('change', (event) => {
			event.target.form.submit();
		});

		const submit = categoryFilter.querySelector('input[type="submit"]');
		submit.style.display = 'none';
	}
};

onDomReady(initialize);
