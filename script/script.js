document.getElementById('switchToLogin').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('form2').classList.add('hidden');
    document.getElementById('form1').classList.remove('hidden');
});

document.getElementById('switchToRegister').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('form2').classList.remove('hidden');
    document.getElementById('form1').classList.add('hidden');
});