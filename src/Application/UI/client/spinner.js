import onDomReady from './onDomReady';

export const spinnerExtension = {
	initialize(naja) {
		onDomReady(() => {
			const mainContent = document.querySelector('.mainContent');

			naja.uiHandler.addEventListener('interaction', (event) => {
				event.detail.options.spinnerTarget = event.detail.element.closest('[data-spinner]');
			});

			naja.addEventListener('start', (event) => (event.detail.options.spinnerTarget ?? mainContent).classList.add('spinner'));
			naja.addEventListener('complete', (event) => (event.detail.options.spinnerTarget ?? mainContent).classList.remove('spinner'));
		});
	}
}
