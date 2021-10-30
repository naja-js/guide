import onDomReady from './onDomReady';

export const categoryFilterExtension = {
	initialize(naja) {
		const enableCategoryFilter = (element) => {
			const categoryFilter = element.querySelector('.categoryFilter');
			if (categoryFilter !== null) {
				const selectBox = categoryFilter.querySelector('select');
				selectBox.addEventListener('change', (event) => {
					naja.uiHandler.submitForm(event.target.form);
				});

				const submit = categoryFilter.querySelector('input[type="submit"]');
				submit.style.display = 'none';
			}
		};

		onDomReady(() => enableCategoryFilter(document));
		naja.snippetHandler.addEventListener('afterUpdate', (event) => enableCategoryFilter(event.detail.snippet));
	}
};
