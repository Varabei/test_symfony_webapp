const toastElList = document.querySelectorAll('.toast');
const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl, {'delay': 5000}))
toastList.forEach((toastEl, idx) => {
	if (idx === 0 ) {
		toastEl.show();
	}
	toastElList[idx].addEventListener('hidden.bs.toast', () => {
		if (idx < toastList.length - 1) {
			toastList[idx + 1].show();
		}
	});
})