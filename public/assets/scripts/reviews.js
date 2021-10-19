if (!!window.reviews) {
	throw new Error('Reviews is already loaded.');
}

window.reviews = {
	init(applicationId) {
		this.applicationId = applicationId;
		this.process(document);
	},
	process(container) {
		container.querySelectorAll('[data-reviews-id]').forEach(this.load.bind(this));
	},
	load(element) {
		const id = element.getAttribute('data-reviews-id');
		element.innerHTML = `<div><h2>Reviews</h2><p>Loading reviews...</p><div><small style="color:silver">application-id ${this.applicationId}, reviews-id ${id}</small></div></div>`;
		window.setTimeout(() => {
			element.innerHTML = `<div><h2>Reviews</h2><p>No reviews found.</p><div><small style="color:silver">application-id ${this.applicationId}, reviews-id ${id}</small></div></div>`;
		}, 500 + Math.random() * 1000);
	},
};

if (document.readyState !== 'loading') {
	window.reviews.init(window.reviews_application_id);
} else {
	document.addEventListener('DOMContentLoaded', () => window.reviews.init(window.reviews_application_id));
}
