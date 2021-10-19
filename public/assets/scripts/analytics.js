const pageviews = [];
window.analytics = {
	trackPageview(url, title) {
		pageviews.push({
		 	url: url ?? window.location.href,
			title: title ?? window.document.title,
		});
	},
	listPageviews() {
		return [...pageviews];
	},
};

if (document.readyState !== 'loading') {
	window.analytics.trackPageview();
} else {
	document.addEventListener('DOMContentLoaded', () => window.analytics.trackPageview());
}
