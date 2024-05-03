window.addEventListener('scroll', function() {
    var header = document.querySelector('.header');
    var title = document.querySelector('.title');
    var headerHeight = header.offsetHeight;
    var titlePosition = title.getBoundingClientRect().top;
    var about = document.querySelector(".about");
    var aboutPosition = about.getBoundingClientRect().top;
    var aboutHeight = about.offsetHeight;
    var loginImage = document.getElementById("logoHeader2");

    if (titlePosition < headerHeight)
    {
        header.classList.add('scrolled');
        loginImage.src = "img/login1.png";
    }
    else
    {
        header.classList.remove('scrolled');
        loginImage.src = "img/login2.png";
    }

    if (aboutPosition <= headerHeight) {
        header.classList.remove('scrolled');
        header.classList.add('scrolled2');
        loginImage.src = "img/login1.png";
    } else {
        header.classList.remove('scrolled2');
    }
});