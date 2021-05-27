$('.currentDate').on('click', function(e) {
    document.getElementById('newDate').classList.remove('d-none');
});

$('#newDate').on('change', function(e) {
    e.preventDefault();
    let newDate = document.getElementById('newDate');
    let date = newDate.value;
    console.log(date);

    window.location.href = '/home?date=' + date;

    newDate.classList.add('d-none');
});


