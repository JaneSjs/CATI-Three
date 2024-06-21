document.addEventListener('DOMContentLoaded', function () {
	checkPageExpiration();
});

window.addEventListener('pageshow', function (event) {
	if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
		checkPageExpiration();
	}
});

function checkPageExpiration() {
	fetch(window.location.href, { method: 'GET' })
		.then(response => {
			console.log("Response Headers: ", response.headers);
			if (response.headers.get('X-Page-Expired') === 'true') {
				console.log("Expire the page ? ", response.headers.get('X-Page-Expired'));
				document.body.innerHTML = '';
			}
		}).catch(error => {
			console.error('Error checking page expiration: ', error);
		});
}