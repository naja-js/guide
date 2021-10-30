import onDomReady from './onDomReady';

export const spinnerExtension = {
	initialize(naja) {
		onDomReady(() => {
			const mainContent = document.querySelector('.mainContent');
			naja.addEventListener('start', () => mainContent.classList.add('spinner'));
			naja.addEventListener('complete', () => mainContent.classList.remove('spinner'));
		});
	}
}
