const deleteBtns = document.querySelectorAll('.delete-form') || [];
deleteBtns.forEach(btn => btn.addEventListener('submit', e => {
	e.stopPropagation();
	e.preventDefault();
	if (confirm('Do you really want to delete this notification?')) {
		e.target.submit();
	}
}));