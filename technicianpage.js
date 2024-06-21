document.getElementById('completedJobs').addEventListener('click', function() {
    window.location.href = 'sql_select.php';
});

document.getElementById('uncompletedJobs').addEventListener('click', function() {
    window.location.href = 'sql_select_updated.php';
});
