import naja from 'naja';

naja.addEventListener('success', (event) => {
	// do not track local actions
	if (event.detail.options.history !== 'replace') {
		window.analytics?.trackPageview(/* url, title */);
	}
});

naja.historyHandler.addEventListener('restoreState', () => window.analytics?.trackPageview());
